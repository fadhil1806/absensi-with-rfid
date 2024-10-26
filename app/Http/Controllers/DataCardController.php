<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use Carbon\Carbon;
use App\Models\DataCard;
use App\Models\DataCardAlert;
use App\Models\Siswa;
use App\Models\Tendik;
use App\Models\Waktu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DataCardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function indexSiswa()
    {
        // Mendapatkan semua data kartu
        $data = DataCard::where('status', 'siswa')->with('siswa')->get();
        return view('card.index', data: compact('data'));
    }

    public function indexTendik()
    {
        $data = DataCard::where('status', operator: 'tendik')->with('tendik')->get();
        return view('card.index-tendik', data: compact('data'));
    }

    public function addAlert($id)
    {
        $data = DataCardAlert::findOrFail($id);
        return view('card.new-data-card', data: compact('data', 'id'));
    }

    public function indexAlert()
    {
        $data = DataCardAlert::orderBy('created_at', 'desc')->get();
        return view('card.index-alert', data: compact('data'));
    }


    public function getSiswa()
    {
        $siswa = Siswa::all(); // Ambil semua data siswa
        return response()->json($siswa); // Kembalikan sebagai JSON
    }

    public function getTendik()
    {
        $tendik = Tendik::all(); // Ambil semua data tendik
        return response()->json($tendik); // Kembalikan sebagai JSON
    }

    public function addDataCard(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'card_id' => 'required|string|max:100',
            'data_id' => 'required',
            'status' => 'required|in:siswa,tendik',
        ]);

        // Cek apakah sudah terdaftar
        $dataCardExists = DataCard::where('card_id', $request->card_id)->exists();

        // Jika data sudah ada
        if ($dataCardExists) {
            return redirect(to: '/data-card/alert')->with('message', 'ID pada kartu sudah digunakan sebelumnya.');
        }

        $dataCardAttributes = [
            'card_id' => $request->card_id,
            'status' => $request->status,
        ];

        if ($request->status === 'siswa') {
            $dataCardUserExists = DataCard::where('siswa_id', $request->data_id)->exists();
            $dataCardAttributes['siswa_id'] = $request->data_id;
        } else {
            $dataCardUserExists = DataCard::where('tendik_id', $request->data_id)->exists();
            $dataCardAttributes['tendik_id'] = $request->data_id;
        }

        if ($dataCardUserExists) {
            return redirect(to: '/data-card/alert')->with('message', 'Data kartu sudah digunakan oleh siswa atau tendik.');
        }

        $newDataCard = DataCard::create($dataCardAttributes);

        DataCardAlert::where('card_id', $request->card_id)->update([
            'data_card_id' => $newDataCard->id,
            'status' => 'terdaftar'
        ]);

        return redirect(to: '/data-card/alert')->with('message', 'Data kartu berhasil disimpan dengan sukses.');
    }

    public function store(Request $request)
    {
        $card_id = $request->input('id');
        $request->validate([
            'id' => 'required|string|max:100',
        ]);

        $existingCard = DataCard::where('card_id', $card_id)->first();

        if ($existingCard) {
            $waktuTerkini = Carbon::now();
            $getSiswa = null;
            $getTendik = null;

            if ($existingCard->status == 'siswa') {
                $getSiswa = Siswa::where('id', $existingCard->siswa_id)->first();

                if (!$getSiswa) {
                    return response()->json(['message' => 'Data siswa tidak ditemukan'], 404);
                }
            } elseif ($existingCard->status == 'tendik') {
                $getTendik = Tendik::where('id', $existingCard->tendik_id)->first();

                if (!$getTendik) {
                    return response()->json(['message' => 'Data tendik tidak ditemukan'], 404);
                }

                // Cek apakah ada absensi tendik kemarin yang belum diisi jam pulangnya
                $absensiTendikKemarin = Absensi::where('tendik_id', $getTendik->id)
                    ->whereDate('jam_masuk', Carbon::yesterday())
                    ->whereNull('jam_pulang')
                    ->first();

                if ($absensiTendikKemarin) {
                    $jamPulangTendik = Carbon::parse($absensiTendikKemarin->jam_masuk)->addDay();

                    // Cek apakah waktu sekarang masih sebelum jam pulang yang diharapkan
                    if ($waktuTerkini->lessThan($jamPulangTendik)) {
                        return redirect()->back()->with('message', 'Anda belum absen pulang dari kemarin.');
                    }
                }
            } else {
                return response()->json(['message' => 'Status tidak dikenal.'], 400);
            }

            // Cek apakah user sudah melakukan absensi pada hari ini
            $absenExist = Absensi::whereDate('jam_masuk', '=', Carbon::today())
                ->where(function ($query) use ($getSiswa, $getTendik) {
                    if ($getSiswa) {
                        $query->where('siswa_id', $getSiswa->id);
                    } elseif ($getTendik) {
                        $query->where('tendik_id', $getTendik->id);
                    }
                })
                ->first();

            if ($absenExist) {
                return response()->json(['message' => 'Anda sudah absen hari ini'], 200);
            }

            // Jika belum absen, simpan absensi baru

            if (is_null($getSiswa)) {
                // Logika Absensi untuk Tendik
                $status = '';

                $jamMasukTendik = $getTendik->jam_masuk;

                if ($waktuTerkini->greaterThan($jamMasukTendik)) {
                    $status = 'Terlambat';
                } else {
                    $status = 'Tepat Waktu';
                }

                // Simpan absensi tendik
                Absensi::create([
                    'tendik_id' => $getTendik->id,
                    'jam_masuk' => $waktuTerkini,
                    'status'    => $status
                ]);

                // Kirim pesan WA untuk tendik
                try {
                    $response = Http::post('http://localhost:3000/waapi', [
                        'token' => 'shjdksahlsakjdkaqijdsajhda',
                        'nohp' => $getTendik->nomor_whatsapp,
                        'pesan' =>
                        '*SMK TI BAZMA*
Presensi : ' . $waktuTerkini->isoFormat('dddd, D MMMM Y') . '

Nama           : *' . $getTendik->nama . '*
No.Induk      : ' . $getTendik->nik . '
Presensi       : *' . 'Masuk' . '*
Role               : ' . 'Tendik' . '
Jam Absen  : ' . $waktuTerkini->format('H:i') . '
keterangan  : *' . $status . '*

Notification sent by the system
*E-Absensi Digital SMK TI BAZMA*',
                    ]);

                    $responseData = $response->json();
                    if ($response->successful()) {
                        if ($responseData['status'] === 'error') {
                            $pesanT = "Gagal mengirim pesan: " . $responseData['pesan'];
                        } else {
                            $pesanT = "Pesan berhasil dikirim!";
                        }
                    } else {
                        $pesanT = "Gagal mengirim pesan: " . $responseData['pesan'];
                    }
                } catch (\Throwable $th) {
                    $pesanT = "Tidak tersambung Dengan WA";
                }
            } else {
                // Logika Absensi untuk Siswa
                $statusSiswa = '';

                $jamMasukSiswa = Waktu::find(1)->jam_masuk; // Ambil hanya jam_masuk

                if ($waktuTerkini->greaterThan($jamMasukSiswa)) {
                    $statusSiswa = 'Terlambat';
                } else {
                    $statusSiswa = 'Tepat Waktu';
                }

                // Simpan absensi siswa
                Absensi::create([
                    'siswa_id' => $getSiswa->id,
                    'jam_masuk' => $waktuTerkini,
                    'status'    => $statusSiswa
                ]);

                // Kirim pesan WA untuk siswa
                try {
                    $response = Http::post('http://localhost:3000/waapi', [
                        'token' => 'shjdksahlsakjdkaqijdsajhda',
                        'nohp' => $getSiswa->nomor_whatsapp,
                        'pesan' =>
                        '*SMK TI BAZMA*
Presensi : ' . $waktuTerkini->isoFormat('dddd, D MMMM Y') . '

Nama           : *' . $getSiswa->nama . '*
No.Induk      : ' . $getSiswa->nisn . '
Presensi       : *Masuk*
Kelas            : ' . $getSiswa->kelas . '
Jam Absen  : ' . $waktuTerkini->format('H:i') . '
keterangan  : *' . $statusSiswa . '*

Notification sent by the system
*E-Absensi Digital SMK TI BAZMA*',
                    ]);

                    $responseData = $response->json();
                    if ($response->successful()) {
                        if ($responseData['status'] === 'error') {
                            $pesanS = "Gagal mengirim pesan: " . $responseData['pesan'];
                        } else {
                            $pesanS = "Pesan berhasil dikirim!";
                        }
                    } else {
                        $pesanS = "Gagal mengirim pesan: " . $responseData['pesan'];
                    }
                } catch (\Throwable $th) {
                    $pesanS = "Tidak tersambung Dengan WA";
                }
            }

            // Kembalikan pesan berdasarkan apakah itu tendik atau siswa
            if (is_null($getSiswa)) {
                return response()->json(['message' => 'Absensi tendik berhasil disimpan. ' . $pesanT], 200);
            } else {
                return response()->json(['message' => 'Absensi siswa berhasil disimpan. ' . $pesanS], 200);
            }
        } else {
            // Jika kartu tidak terdaftar, buat alert
            DataCardAlert::create([
                'card_id' => $card_id,
                'status' => 'tidak terdaftar'
            ]);

            return response()->json(['Kartu belum terdaftar'], 201);
        }
    }


    public function show($id)
    {
        // Menampilkan data kartu berdasarkan ID
        $dataCard = DataCard::findOrFail($id);
        return response()->json($dataCard);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'card_id' => 'string|max:100',
            'tendik_id' => 'exists:tendik,id',
            'siswa_id' => 'exists:siswa,id',
            'status' => 'in:tendik,siswa',
        ]);

        // Mengupdate data kartu
        $dataCard = DataCard::findOrFail($id);
        $dataCard->update($request->all());
        return response()->json($dataCard);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $dataCard = DataCard::findOrFail($id);
        if (!$dataCard) {
            return back()->with('message', 'Data kartu tidak di temukan.');
        }
        $dataCard->delete();

        return back()->with('message', 'Data kartu berhasil dihapus.');
    }
}
length:

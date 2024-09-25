<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Izin;
use App\Models\Siswa;
use App\Models\Waktu;
use App\Models\Tendik;
use App\Models\Absensi;
use App\Http\Requests\AbsenRequest;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $siswaCount = Siswa::count();
        $tendikCount = Tendik::count();
        $absensiAllToday = Absensi::whereDate('jam_masuk', Carbon::today())->get();
        $absensiTendikKemarin = Absensi::whereDate('jam_masuk', Carbon::today()->subDay())
            ->whereNotNull('tendik_id')
            ->whereNull('jam_pulang')
            ->whereHas('tendik', function ($query) {
                $query->whereRaw('jam_pulang < jam_masuk');
            })
            ->get();
        $absensi = $absensiAllToday->merge($absensiTendikKemarin);

        $totalTerlambat = Absensi::whereDate('jam_masuk', Carbon::today())->whereNull('tendik_id')->where('status', 'Terlambat')->count();
        $totalOntime = Absensi::whereDate('jam_masuk', Carbon::today())->whereNull('tendik_id')->where('status',  'Tepat Waktu')->count();
        $waktu = Waktu::find(1);

        $baseQuery = Siswa::leftJoin('absensi', function ($join) {
            $join->on('siswa.id', '=', 'absensi.siswa_id')
                ->whereDate('absensi.jam_masuk', Carbon::today());
        })->whereNull('absensi.siswa_id');

        $belumMasuk = (clone $baseQuery)->count();
        $belumMasuk10 = (clone $baseQuery)->where('siswa.kelas', 'Kelas 10')->count();
        $belumMasuk11 = (clone $baseQuery)->where('siswa.kelas', 'Kelas 11')->count();
        $belumMasuk12 = (clone $baseQuery)->where('siswa.kelas', 'Kelas 12')->count();

        $role = 'Siswa';
        $totalIzin = Izin::whereDate('updated_at', Carbon::today())->where('jenis_izin', 'Izin')->whereHas('siswa', function ($query) use ($role) {
            $query->where('role', $role);
        })->count();
        $totalSakit = Izin::whereDate('updated_at', Carbon::today())->where('jenis_izin', 'Sakit')->whereHas('siswa', function ($query) use ($role) {
            $query->where('role', $role);
        })->count();
        $totalAlpa = Izin::whereDate('updated_at', Carbon::today())->where('jenis_izin', 'Alpa')->whereHas('siswa', function ($query) use ($role) {
            $query->where('role', $role);
        })->count();

        $dates = [];
        $today = Carbon::today();
        for ($i = 0; $i < 30; $i++) {
            $dates[] = $today->copy()->subDays($i)->format('Y-m-d');
        }
        $dates = array_reverse($dates);

        $punctualityData = [];
        foreach ($absensi as $item) {
            if ($item->siswa_id !== null) {
                $siswaId = $item->siswa_id;
                if (!isset($punctualityData[$siswaId])) {
                    $punctualityData[$siswaId] = ['ontime' => [], 'late' => []];
                }
                foreach ($dates as $date) {
                    $ontimeCount = Absensi::where('siswa_id', $siswaId)
                        ->whereDate('jam_masuk', '<=', $date)
                        ->where('status', 'Tepat Waktu')
                        ->count();
                    $lateCount = Absensi::where('siswa_id', $siswaId)
                        ->whereDate('jam_masuk', '<=', $date)
                        ->where('status', 'Terlambat')
                        ->count();

                    $totalAbsensiCount = ($ontimeCount + $lateCount);

                    $ontimePercentage = $totalAbsensiCount > 0 ? round(($ontimeCount / $totalAbsensiCount) * 100) : 0;
                    $latePercentage = $totalAbsensiCount > 0 ? round(($lateCount / $totalAbsensiCount) * 100) : 0;

                    $punctualityData[$siswaId]['ontime'][$date] = $ontimePercentage;
                    $punctualityData[$siswaId]['late'][$date] = $latePercentage;
                }
            } elseif ($item->tendik_id !== null) {
                $tendikId = $item->tendik_id;
                if (!isset($punctualityData[$tendikId])) {
                    $punctualityData[$tendikId] = ['ontime' => [], 'late' => []];
                }
                foreach ($dates as $date) {
                    $ontimeCount = Absensi::where('tendik_id', $tendikId)
                        ->whereDate('jam_masuk', '<=', $date)
                        ->where('status', 'Tepat Waktu')
                        ->count();
                    $lateCount = Absensi::where('tendik_id', $tendikId)
                        ->whereDate('jam_masuk', '<=', $date)
                        ->where('status', 'Terlambat')
                        ->count();

                    $totalAbsensiCount = ($ontimeCount + $lateCount);

                    $ontimePercentage = $totalAbsensiCount > 0 ? round(($ontimeCount / $totalAbsensiCount) * 100) : 0;
                    $latePercentage = $totalAbsensiCount > 0 ? round(($lateCount / $totalAbsensiCount) * 100) : 0;

                    $punctualityData[$tendikId]['ontime'][$date] = $ontimePercentage;
                    $punctualityData[$tendikId]['late'][$date] = $latePercentage;
                }
            }
        }

        return view('home', compact('tendikCount', 'siswaCount', 'absensi', 'waktu', 'totalOntime', 'totalTerlambat', 'belumMasuk', 'belumMasuk10', 'belumMasuk11', 'belumMasuk12', 'totalIzin', 'totalSakit', 'totalAlpa', 'dates', 'punctualityData'));
    }
    public function masuk(AbsenRequest $request)
    {
        $request->validated();

        $getSiswa = Siswa::where('nisn', $request->noid)
            ->first();

        $getTendik = Tendik::where('nik', $request->noid)
            ->first();

        if (is_null($getSiswa) && is_null($getTendik)) {
            return redirect()->back()->with('message', 'Data tidak ditemukan.');
        }

        $waktuTerkini = Carbon::now();
        if (is_null($getSiswa)) {
            $absensiTendikKemarin = Absensi::where('tendik_id', $getTendik->id)
                ->whereDate('jam_masuk', Carbon::yesterday())
                ->whereNotNull('tendik_id')

                ->whereNull('jam_pulang')
                ->whereHas('tendik', function ($query) {
                    $query->whereRaw('jam_pulang < jam_masuk');
                })
                ->first();

            if ($absensiTendikKemarin) {
                $jamPulangTendik = Carbon::parse($absensiTendikKemarin->jam_masuk)->addDay()->format('Y-m-d');
                if ($waktuTerkini->lessThan($jamPulangTendik . $getTendik->jam_pulang)) {
                    return redirect()->back()->with('message', 'Anda sudah absen masuk hari ini atau pada jam anda.');
                }
            }
        }

        $absenExist = Absensi::whereDate('jam_masuk', '=', Carbon::today())
            ->where(function ($query) use ($getSiswa, $getTendik) {
                if ($getSiswa) {
                    $query->where('siswa_id', $getSiswa->id);
                } else {
                    $query->where('tendik_id', $getTendik->id);
                }
            })
            ->first();

        if ($absenExist) {
            return redirect()->back()->with('message', 'Anda sudah absen masuk hari ini atau pada jam anda.');
        }

        $waktu = Waktu::find(1);
        $pesanT = "";
        if (is_null($getSiswa)) {
            $status = '';

            $jamMasukTendik =  $getTendik->jam_masuk;

            if ($waktuTerkini->greaterThan($jamMasukTendik)) {
                $status = 'Terlambat';
            } else {
                $status = 'Tepat Waktu';
            }
            Absensi::create([
                'tendik_id' => $getTendik->id,
                'jam_masuk' => $waktuTerkini,
                'status'    => $status
            ]);
            try {
                // $singkatNamaGuru = ucwords(substr($getTendik->nama,0,27));
                $response = Http::post('http://localhost:3000/waapi', data: [
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
        } elseif (is_null($getTendik)) {
            $status = '';

            $jamMasuk = $waktu->jam_masuk;

            if ($waktuTerkini->greaterThan($jamMasuk)) {
                $status = 'Terlambat';
            } else {
                $status = 'Tepat Waktu';
            }

            Absensi::create([
                'siswa_id'  => $getSiswa->id,
                'jam_masuk' => $waktuTerkini,
                'status'    => $status
            ]);
            try {
                $singkatNamaSiswa = ucwords(substr($getSiswa->nama, 0, 27));
                $response = Http::post('http://localhost:3000/waapi', [
                    'token' => 'shjdksahlsakjdkaqijdsajhda',
                    'nohp' => $getSiswa->nomor_whatsapp,
                    'pesan' =>
                    '*SMK TI BAZMA*
Presensi : ' . $waktuTerkini->isoFormat('dddd, D MMMM Y') . '

Nama           : *' . $singkatNamaSiswa . '*
No.Induk      : ' . $getSiswa->nisn . '
Presensi       : *' . 'Masuk' . '*
Kelas            : ' . $getSiswa->kelas . '
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
        }

        return redirect()->back()->with('success', 'Berhasil melakukan absensi masuk ' . $pesanT);
    }

    public function pulang(AbsenRequest $request)
    {
        $request->validated();

        $getSiswa = Siswa::where('nisn', $request->noid)
            ->first();

        $getTendik = Tendik::where('nik', $request->noid)
            ->first();

        if (is_null($getSiswa) && is_null($getTendik)) {
            return redirect()->back()->with('message', 'Data tidak ditemukan.');
        }

        $waktu = Waktu::find(1);
        $waktuTerkini = Carbon::now();

        if (is_null($getSiswa)) {
            $absensiTendikKemarin = Absensi::where('tendik_id', $getTendik->id)
                ->whereDate('jam_masuk', Carbon::yesterday())
                ->whereNotNull('tendik_id')
                ->whereNull('jam_pulang')
                ->whereHas('tendik', function ($query) {
                    $query->whereRaw('jam_pulang < jam_masuk');
                })
                ->first();

            $jamPulangTendik =  '';
            $jamMasukTendik = strtotime($getTendik->jam_masuk);
            $newJamPulangTendik = strtotime($getTendik->jam_pulang);
            if ($absensiTendikKemarin) {
                if ($newJamPulangTendik < $jamMasukTendik) {
                    $jamMasukDate = Carbon::parse($absensiTendikKemarin->jam_masuk)->format('Y-m-d');
                    $jamPulangTendik = Carbon::parse($jamMasukDate . ' ' . $getTendik->jam_pulang)->addDay();
                } else {
                    $jamPulangTendik =  $getTendik->jam_pulang;
                }

                if ($absensiTendikKemarin) {
                    if ($waktuTerkini->lessThan($jamPulangTendik)) {
                        return redirect()->back()->with('error', 'Belum Jam Pulang');
                    } else {
                        $absensiTendikKemarin->update(['jam_pulang' => $waktuTerkini]);
                    }
                } else {
                    return redirect()->back()->with('error', 'Belum melakukan absen masuk.');
                }
            } else {
                $absensi = Absensi::where('tendik_id', $getTendik->id)
                    ->whereNull('jam_pulang')
                    ->whereDate('jam_masuk', Carbon::today())
                    ->first();

                if ($newJamPulangTendik < $jamMasukTendik) {
                    $jamMasukDate = Carbon::parse($absensi->jam_masuk)->format('Y-m-d');
                    $jamPulangTendik = Carbon::parse($jamMasukDate . ' ' . $jamPulangTendik)->addDay();
                } else {
                    $jamPulangTendik =  $getTendik->jam_pulang;
                }

                if ($absensi) {
                    if ($waktuTerkini->lessThan($jamPulangTendik)) {
                        return redirect()->back()->with('error', 'Belum Jam Pulang');
                    } else {
                        $absensi->update(['jam_pulang' => $waktuTerkini]);
                    }
                } else {
                    return redirect()->back()->with('error', 'Belum melakukan absen masuk.');
                }
            }
        } elseif (is_null($getTendik)) {
            $absensi = Absensi::where('siswa_id', $getSiswa->id)
                ->whereNull('jam_pulang')
                ->whereDate('jam_masuk', Carbon::today())
                ->first();

            $jamPulang =  $waktu->jam_pulang;
            if ($absensi) {
                if ($waktuTerkini->lessThan($jamPulang)) {
                    return redirect()->back()->with('error', 'Belum Jam Pulang');
                } else {
                    $absensi->update(['jam_pulang' => $waktuTerkini]);
                }
            } else {
                return redirect()->back()->with('error', 'Anda belum melakukan absen masuk.');
            }
        }

        return redirect()->back()->with('success', 'Berhasil melakukan absensi pulang');
    }
}

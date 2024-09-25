<?php

namespace App\Http\Controllers;

use App\Http\Requests\IzinRequest;
use Illuminate\Http\Request;
use App\Models\Izin;
use App\Models\Tendik;
use App\Models\Siswa;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class IzinController extends Controller
{
    public function index()
    {
        $izin = Izin::whereDate('created_at', Carbon::today())->orderBy('created_at', 'desc')->paginate(10);
        $tendik = tendik::get();
        $siswa = siswa::get();
        return view('admin.izin', compact('izin', 'tendik', 'siswa'));
    }
    public function store(IzinRequest $request)
    {
        $request->validated();

        try {
            $fotoName = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('img/foto'), $fotoName);

            DB::transaction(function () use ($request, $fotoName) {
                $getSiswa = Siswa::where('nisn', $request->nama)
                    ->first();
                $getTendik = Tendik::where('nik', $request->nama)
                    ->first();

                $created_at = Carbon::createFromFormat('Y-m-d', $request->tanggal)->startOfDay();
                if (is_null($getSiswa)) {
                    Izin::create([
                        'tendik_id'    => $getTendik->id,
                        'jenis_izin'   => $request->jenis_izin,
                        'created_at'      => $created_at,
                        'jam_mulai'    => $request->jam_mulai,
                        'jam_berakhir' => $request->jam_berakhir,
                        'keterangan'   => $request->keterangan,
                        'foto'         => $fotoName,
                    ]);
                }

                if (is_null($getTendik)) {
                    Izin::create([
                        'siswa_id'     => $getSiswa->id,
                        'jenis_izin'   => $request->jenis_izin,
                        'created_at'   => $created_at,
                        'jam_mulai'    => $request->jam_mulai,
                        'jam_berakhir' => $request->jam_berakhir,
                        'keterangan'   => $request->keterangan,
                        'foto'         => $fotoName,
                    ]);
                }
            });
            return redirect()->to('/izin')->with('create', 'Data Izin Berhasil Dibuat');
        } catch (\Throwable $th) {
            report($th);
            return redirect()->to('/izin')->with('error', 'Data Izin Tidak Berhasil Dibuat');
        }
    }
    public function edit($id)
    {
        $izin = Izin::findOrFail($id);
        return view('admin.izin', compact('izin'));
    }
    public function update(IzinRequest $request, $id)
    {
        $validatedData = $request->validated();

        try {
            DB::beginTransaction();

            $izin = Izin::findOrFail($id);
            $izin->update($validatedData);

            if ($request->hasFile('foto')) {
                $path = "img/foto/";
                File::delete($path . $izin->foto);

                $fotoName = time() . '.' . $request->foto->extension();
                $request->foto->move(public_path('img/foto'), $fotoName);

                $izin->foto = $fotoName;
            }

            $izin->save();

            DB::commit();

            return redirect()->to('/izin')->with('update', 'Data Izin Berhasil Diperbarui');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect('/izin')->with('error', 'Terjadi kesalahan saat memperbarui data Izin: ' . $th->getMessage());
        }

        if ($request->has('foto')) {
            $created_at = Carbon::createFromFormat('Y-m-d', $request->tanggal)->startOfDay();
            $path = "img/foto/";
            File::delete($path . $izin->foto);

            $fotoName = time() . '.' . $request->foto->extension();

            $request->foto->move(public_path('img/foto'), $fotoName);

            Izin::findOrFail($id)->update([
                'siswa_id'     => $request->nama,
                'jenis_izin'   => $request->jenis_izin,
                'created_at'      => $created_at,
                'jam_mulai'    => $request->jam_mulai,
                'jam_berakhir' => $request->jam_berakhir,
                'keterangan'   => $request->keterangan,
                'foto'         => $fotoName,
            ]);

            return redirect('/platform');
        } else {
            $created_at = Carbon::createFromFormat('Y-m-d', $request->tanggal)->startOfDay();
            Izin::findOrFail($id)->update([
                'siswa_id'     => $request->nama,
                'jenis_izin'   => $request->jenis_izin,
                'created_at'   => $created_at,
                'jam_mulai'    => $request->jam_mulai,
                'jam_berakhir' => $request->jam_berakhir,
                'keterangan'   => $request->keterangan,
                'foto'         => $fotoName,
            ]);

            return redirect()->to('/platform')->with('success', 'Data Platform Berhasil Diperbarui');
        }
    }
    public function destroy($id)
    {
        Izin::findOrFail($id)->delete();
        return redirect()->to('/izin')->with('delete', 'Data Izin Berhasil Dihapus');
    }
}

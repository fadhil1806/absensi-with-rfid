<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Imports\SiswaImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;

class SiswaController extends Controller
{
    public function index()
    {
        $siswa = Siswa::orderBy('kelas')->orderBy('nama')->paginate(10)->withQueryString();

        return view('admin.siswa', compact('siswa'));
    }

    public function siswaFilter(Request $request)
    {
        $kelas = $request->kelas;
        $cari = $request->cari;
        $siswa = Siswa::orderBy('kelas')->orderBy('nama')->paginate(10);
        if ($kelas != 'Semua' && $cari != null) {
            $siswa = Siswa::where('kelas', $kelas)->whereAny(['nama', 'nisn', 'tempat_lahir', 'tanggal_lahir'], 'LIKE', '%' . $cari . '%')->orderBy('nama')->paginate(10)->withQueryString();
        } elseif ($cari == null) {
            if ($kelas == 'Semua') {
                $siswa = Siswa::orderBy('kelas')->orderBy('nama')->paginate(10)->withQueryString();
            } else {
                $siswa = Siswa::where('kelas', $kelas)->orderBy('nama')->paginate(10)->withQueryString();
            }
        } elseif ($kelas == 'Semua' && $cari != null) {
            $siswa = Siswa::whereAny(['nama', 'nisn', 'tempat_lahir', 'tanggal_lahir'], 'LIKE', '%' . $cari . '%')->orderBy('nama')->paginate(10)->withQueryString();
        }
        return view('admin.siswa', compact('siswa', 'kelas', 'cari'));
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nisn'           => 'required|unique:siswa,nisn',
            'nama'           => 'required',
            'jenis_kelamin'  => 'required',
            'kelas'          => 'required',
            'tempat_lahir'   => 'required',
            'tanggal_lahir'  => 'required',
            'role'           => 'required',
            'nomor_whatsapp' => 'required',
            'foto'           => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        try {
            $fotoName = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('img/foto'), $fotoName);

            DB::transaction(function () use ($request, $fotoName) {
                $siswa = new Siswa;

                $siswa->nisn           = $request->nisn;
                $siswa->nama           = $request->nama;
                $siswa->jenis_kelamin  = $request->jenis_kelamin;
                $siswa->kelas          = $request->kelas;
                $siswa->tempat_lahir   = $request->tempat_lahir;
                $siswa->tanggal_lahir  = $request->tanggal_lahir;
                $siswa->role           = $request->role;
                $siswa->nomor_whatsapp = $request->nomor_whatsapp;
                $siswa->foto           = $fotoName;

                $siswa->save();
            });
            return redirect('/siswa')->with('success', 'Data Siswa Berhasil Dibuat');
        } catch (\Throwable $th) {
            report($th);
            return redirect('/siswa')->with('error', 'Terjadi kesalahan saat menyimpan data');
        }
    }
    public function edit($id)
    {
        $siswa = Siswa::findOrFail($id);
        return view('admin.siswa', compact('siswa'));
    }
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nisn'           => 'required',
            'nama'           => 'required',
            'jenis_kelamin'  => 'required',
            'kelas'          => 'required',
            'tempat_lahir'   => 'required',
            'tanggal_lahir'  => 'required',
            'role'           => 'required',
            'nomor_whatsapp' => 'required',
            'foto'           => 'image|mimes:jpg,png,jpeg|max:2048',
        ]);

        try {
            DB::beginTransaction();

            $siswa = Siswa::findOrFail($id);
            $siswa->update($validatedData);

            if ($request->hasFile('foto')) {
                $path = "img/foto/";
                File::delete($path . $siswa->foto);

                $fotoName = time() . '.' . $request->foto->extension();
                $request->foto->move(public_path('img/foto'), $fotoName);

                $siswa->foto = $fotoName;
            }

            $siswa->save();

            DB::commit();

            return redirect('/siswa')->with('success', 'Data Siswa Berhasil Diperbarui');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect('/siswa')->with('error', 'Terjadi kesalahan saat memperbarui data Siswa: ' . $th->getMessage());
        }


        if ($request->has('foto')) {
            $siswa = Siswa::find($id);

            $path = "img/foto/";
            File::delete($path . $siswa->foto);

            $fotoName = time() . '.' . $request->foto->extension();

            $request->foto->move(public_path('img/foto'), $fotoName);

            $siswa->nisn           = $request->nisn;
            $siswa->nama           = $request->nama;
            $siswa->jenis_kelamin  = $request->jenis_kelamin;
            $siswa->kelas          = $request->kelas;
            $siswa->tempat_lahir   = $request->tempat_lahir;
            $siswa->tanggal_lahir  = $request->tanggal_lahir;
            $siswa->role           = $request->role;
            $siswa->nomor_whatsapp = $request->nomor_whatsapp;
            $siswa->foto           = $fotoName;

            $siswa->save();

            return redirect('/siswa');
        } else {
            $siswa = Siswa::find($id);

            $siswa->nisn           = $request->nisn;
            $siswa->nama           = $request->nama;
            $siswa->jenis_kelamin  = $request->jenis_kelamin;
            $siswa->kelas          = $request->kelas;
            $siswa->tempat_lahir   = $request->tempat_lahir;
            $siswa->tanggal_lahir  = $request->tanggal_lahir;
            $siswa->role           = $request->role;
            $siswa->nomor_whatsapp = $request->nomor_whatsapp;

            $siswa->save();

            return redirect('/siswa')->with('success', 'Data Siswa Berhasil Diperbarui');
        }
    }
    public function destroy($id)
    {
        $siswa = Siswa::find($id);

        $path = "img/cover/";
        File::delete($path . $siswa->cover);
        $siswa->delete();

        return redirect('/siswa')->with('success', 'Data Siswa Berhasil Dihapus');
    }
    public function show($id)
    {
        $siswa = siswa::find($id);
        return view('admin.izin', ['siswa' => $siswa]);
    }
    public function importSiswa(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|mimes:xls,xlsx'
        ]);
        Excel::import(new SiswaImport, $request->file('excel_file'));

        return redirect()->back()->with('success', 'Menambahkan data berhasil');
    }
}

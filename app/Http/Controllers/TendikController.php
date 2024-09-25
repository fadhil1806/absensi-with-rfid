<?php

namespace App\Http\Controllers;

use App\Http\Requests\TendikRequest;
use App\Imports\TendikImport;
use App\Models\Tendik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;

class TendikController extends Controller
{
    public function index()
    {
        $tendik = Tendik::orderBy('nama')->paginate(10);
        return view('admin.tendik', compact('tendik'));
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nik'            => 'required|unique:tendik,nik|regex:/^[0-9.]+$/',
            'nama'           => 'required',
            'jenis_kelamin'  => 'required',
            'tempat_lahir'   => 'required',
            'tanggal_lahir'  => 'required',
            'role'           => 'required',
            'jam_masuk'      => 'required',
            'jam_pulang'     => 'required',
            'nomor_whatsapp' => 'required',
            'foto'           => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        try {
            $fotoName = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('img/foto'), $fotoName);

            DB::transaction(function () use ($request, $fotoName) {
                $tendik = new Tendik;

                $tendik->nik            = $request->nik;
                $tendik->nama           = $request->nama;
                $tendik->jenis_kelamin  = $request->jenis_kelamin;
                $tendik->tempat_lahir   = $request->tempat_lahir;
                $tendik->tanggal_lahir  = $request->tanggal_lahir;
                $tendik->role           = $request->role;
                $tendik->jam_masuk      = $request->jam_masuk;
                $tendik->jam_pulang     = $request->jam_pulang;
                $tendik->nomor_whatsapp = $request->nomor_whatsapp;
                $tendik->foto           = $fotoName;

                $tendik->save();
            });
            return redirect('/tendik')->with('create', 'Data Tendik Berhasil Dibuat');
        } catch (\Throwable $th) {
            report($th);
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data.'])->withInput();
        }
    }
    public function edit($id)
    {
        $tendik = Tendik::findOrFail($id);
        return view('admin.tendik', compact('tendik'));
    }
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nik'            => 'required|regex:/^[0-9.]+$/',
            'nama'           => 'required',
            'jenis_kelamin'  => 'required',
            'tempat_lahir'   => 'required',
            'tanggal_lahir'  => 'required',
            'role'           => 'required',
            'jam_masuk'      => 'required',
            'jam_pulang'     => 'required',
            'nomor_whatsapp' => 'required',
            'foto'           => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        try {
            DB::beginTransaction();

            $tendik = Tendik::findOrFail($id);
            $tendik->update($validatedData);

            if ($request->hasFile('foto')) {
                $path = "img/foto/";
                File::delete($path . $tendik->foto);

                $fotoName = time() . '.' . $request->foto->extension();
                $request->foto->move(public_path('img/foto'), $fotoName);

                $tendik->foto = $fotoName;
            }

            $tendik->save();

            DB::commit();

            return redirect('/tendik')->with('update', 'Data Tendik Berhasil Diperbarui');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect('/tendik')->with('error', 'Terjadi kesalahan saat memperbarui data Tendik: ' . $th->getMessage());
        }
    }
    public function destroy($id)
    {
        $tendik = Tendik::find($id);

        $path = "img/cover/";
        File::delete($path . $tendik->cover);
        $tendik->delete();

        return redirect('/tendik')->with('delete', 'Data ' . $tendik->nama . ' Berhasil Dihapus');
    }
    public function show($id)
    {
        $tendik = Tendik::find($id);
        return view('admin.izin', ['tendik' => $tendik]);
    }
    public function importTendik(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|mimes:xls,xlsx'
        ]);
        Excel::import(new TendikImport, $request->file('excel_file'));

        return redirect()->back()->with('success', 'Menambahkan data berhasil');
    }
}

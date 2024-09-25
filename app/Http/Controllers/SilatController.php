<?php

namespace App\Http\Controllers;

use App\Models\Silat;
use Illuminate\Http\Request;
use App\Http\Requests\SilatRequest;

class SilatController extends Controller
{
    public function index()
    {
        $silat = Silat::paginate(10);
        return view('admin.silat', compact('silat'));
    }
    public function store(SilatRequest $request)
    {
        $request->validated();
        $this->create($request);

        return redirect()->to('/silat')->with('success', 'Data Silat Berhasil Dibuat');
    }
    public function edit($id)
    {
        $silat = Silat::findOrFail($id);
        return view('admin.silat', compact('silat'));
    }
    public function update(SilatRequest $request, $id)
    {
        $request->validated();

        Silat::findOrFail($id)->update([
            'pelatih'      => $request->pelatih,
            'tanggal'      => $request->tanggal,
            'jam_mulai'    => $request->jam_mulai,
            'jam_berakhir' => $request->jam_berakhir,
            'kelas'        => $request->kelas,
            'materi'       => $request->materi,
            'hadir'        => $request->hadir,
            'sakit'        => $request->sakit,
            'izin'         => $request->izin,
            'alpa'         => $request->alpa
        ]);

        return redirect()->to('/silat')->with('success', 'Data Silat Berhasil Diperbarui');
    }
    public function destroy($id)
    {
        Silat::findOrFail($id)->delete();
        return redirect()->to('/silat')->with('success', 'Data Silat Berhasil Dihapus');
    }
    private function create($request)
    {
        Silat::create([
            'pelatih'      => $request->pelatih,
            'tanggal'      => $request->tanggal,
            'jam_mulai'    => $request->jam_mulai,
            'jam_berakhir' => $request->jam_berakhir,
            'kelas'        => $request->kelas,
            'materi'       => $request->materi,
            'hadir'        => $request->hadir,
            'sakit'        => $request->sakit,
            'izin'         => $request->izin,
            'alpa'         => $request->alpa
        ]);
    }
}

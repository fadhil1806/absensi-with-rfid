<?php

namespace App\Http\Controllers;

use App\Http\Requests\PramukaRequest;
use App\Models\Pramuka;
use Illuminate\Http\Request;

class PramukaController extends Controller
{
    public function index()
    {
        $pramuka = Pramuka::paginate(10);
        return view('admin.pramuka', compact('pramuka'));
    }
    public function store(PramukaRequest $request)
    {
        $request->validated();
        $this->create($request);

        return redirect()->to('/pramuka')->with('success', 'Data Pramuka Berhasil Dibuat');
    }
    public function edit($id)
    {
        $pramuka = Pramuka::findOrFail($id);
        return view('admin.pramuka', compact('pramuka'));
    }
    public function update(PramukaRequest $request, $id)
    {
        $request->validated();

        Pramuka::findOrFail($id)->update([
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

        return redirect()->to('/pramuka')->with('success', 'Data Pramuka Berhasil Diperbarui');
    }
    public function destroy($id)
    {
        Pramuka::findOrFail($id)->delete();
        return redirect()->to('/pramuka')->with('success', 'Data Pramuka Berhasil Dihapus');
    }
    private function create($request)
    {
        Pramuka::create([
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

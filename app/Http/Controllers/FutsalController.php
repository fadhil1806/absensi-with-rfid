<?php

namespace App\Http\Controllers;

use App\Http\Requests\FutsalRequest;
use App\Models\Futsal;
use Illuminate\Http\Request;

class FutsalController extends Controller
{
    public function index()
    {
        $futsal = Futsal::paginate(10);
        return view('admin.futsal', compact('futsal'));
    }
    public function store(FutsalRequest $request)
    {
        $request->validated();
        $this->create($request);

        return redirect()->to('/futsal')->with('success', 'Data Futsal Berhasil Dibuat');
    }
    public function edit($id)
    {
        $futsal = Futsal::findOrFail($id);
        return view('admin.futsal', compact('futsal'));
    }
    public function update(FutsalRequest $request, $id)
    {
        $request->validated();

        Futsal::findOrFail($id)->update([
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

        return redirect()->to('/futsal')->with('success', 'Data Futsal Berhasil Diperbarui');
    }
    public function destroy($id)
    {
        Futsal::findOrFail($id)->delete();
        return redirect()->to('/futsal')->with('success', 'Data Futsal Berhasil Dihapus');
    }
    private function create($request)
    {
        Futsal::create([
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

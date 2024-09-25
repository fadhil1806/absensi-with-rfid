<?php

namespace App\Http\Controllers;

use App\Http\Requests\KodingRequest;
use App\Models\Koding;
use Illuminate\Http\Request;

class KodingController extends Controller
{
    public function index()
    {
        $koding = Koding::paginate(10);
        return view('admin.koding', compact('koding'));
    }
    public function store(KodingRequest $request)
    {
        $request->validated();
        $this->create($request);

        return redirect()->to('/koding')->with('success', 'Data Koding Berhasil Dibuat');
    }
    public function edit($id)
    {
        $koding = Koding::findOrFail($id);
        return view('admin.koding', compact('koding'));
    }
    public function update(KodingRequest $request, $id)
    {
        $request->validated();

        Koding::findOrFail($id)->update([
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

        return redirect()->to('/koding')->with('success', 'Data Koding Berhasil Diperbarui');
    }
    public function destroy($id)
    {
        Koding::findOrFail($id)->delete();
        return redirect()->to('/koding')->with('success', 'Data Koding Berhasil Dihapus');
    }
    private function create($request)
    {
        Koding::create([
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

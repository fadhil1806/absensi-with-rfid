<?php

namespace App\Http\Controllers;

use App\Http\Requests\JurnalAgendaKelasRequest;
use App\Models\JurnalAgendaKelas;
use App\Models\Tendik;
use Illuminate\Http\Request;

class JurnalAgendaKelasController extends Controller
{
    public function index()
    {
        $jurnal = JurnalAgendaKelas::orderBy('created_at', 'desc')->paginate(10);
        $tendik = Tendik::get();
        return view('admin.jurnalAgendaKelas', compact('jurnal', 'tendik'));
    }
    public function store(JurnalAgendaKelasRequest $request)
    {
        $request->validated();

        $this->create($request);

        return redirect()->to('/jurnal')->with('success', 'Data Jurnal Berhasil Dibuat');
    }
    public function edit($id)
    {
        $jurnal = JurnalAgendaKelas::findOrFail($id);
        return view('admin.jurnalAgendaKelas', compact('jurnal'));
    }
    public function update(JurnalAgendaKelasRequest $request, $id)
    {
        $request->validated();

        JurnalAgendaKelas::findOrFail($id)->update([
            'tendik_id'    => $request->tendik_id,
            'mapel'        => $request->mapel,
            'tanggal'      => $request->tanggal,
            'jam_mulai'    => $request->jam_mulai,
            'jam_berakhir' => $request->jam_berakhir,
            'kelas'        => $request->kelas,
            'materi'       => $request->materi,
            'hadir'        => $request->hadir ? $request->hadir : 0,
            'sakit'        => $request->sakit ? $request->sakit : 0,
            'izin'         => $request->izin ? $request->izin : 0,
            'alpa'         => $request->alpa ? $request->alpa : 0,
            'keterangan'   => $request->keterangan,
        ]);

        $namaTendik = Tendik::find($request->tendik_id);

        return redirect()->to('/jurnal')->with('success', 'Data Jurnal Berhasil Diperbarui ' . $namaTendik->nama);
    }
    public function destroy($id)
    {
        JurnalAgendaKelas::findOrFail($id)->delete();
        return redirect()->to('/jurnal')->with('success', 'Data Jurnal Berhasil Dihapus');
    }
    private function create($request)
    {
        JurnalAgendaKelas::create([
            'tendik_id'    => $request->tendik_id,
            'mapel'        => $request->mapel,
            'tanggal'      => $request->tanggal,
            'jam_mulai'    => $request->jam_mulai,
            'jam_berakhir' => $request->jam_berakhir,
            'kelas'        => $request->kelas,
            'materi'       => $request->materi,
            'hadir'        => $request->hadir ? $request->hadir : 0,
            'sakit'        => $request->sakit ? $request->sakit : 0,
            'izin'         => $request->izin ? $request->izin : 0,
            'alpa'         => $request->alpa ? $request->alpa : 0,
            'keterangan'   => $request->keterangan,
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\RobotikRequest;
use App\Models\Robotik;
use Illuminate\Http\Request;

class RobotikController extends Controller
{
    public function index()
    {
        $robotik = Robotik::paginate(10);
        return view('admin.robotik', compact('robotik'));
    }
    public function store(RobotikRequest $request)
    {
        $request->validated();
        $this->create($request);

        return redirect()->to('/robotik')->with('success', 'Data Robotik Berhasil Dibuat');
    }
    public function edit($id)
    {
        $robotik = Robotik::findOrFail($id);
        return view('admin.robotik', compact('robotik'));
    }
    public function update(RobotikRequest $request, $id)
    {
        $request->validated();

        Robotik::findOrFail($id)->update([
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

        return redirect()->to('/robotik')->with('success', 'Data Robotik Berhasil Diperbarui');
    }
    public function destroy($id)
    {
        Robotik::findOrFail($id)->delete();
        return redirect()->to('/robotik')->with('success', 'Data Robotik Berhasil Dihapus');
    }
    private function create($request)
    {
        Robotik::create([
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

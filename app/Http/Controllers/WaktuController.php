<?php

namespace App\Http\Controllers;

use App\Models\Waktu;
use Illuminate\Http\Request;

class WaktuController extends Controller
{
    public function index()
    {
        $waktu = Waktu::get();
        return view('admin.waktu', compact('waktu'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jam_masuk'  => 'required',
            'jam_pulang' => 'required'
        ]);

        Waktu::findOrFail($id)->update([
            'jam_masuk' => $request->jam_masuk,
            'jam_pulang' => $request->jam_pulang,
        ]);

        return redirect()->back()->with('success', 'Jam telah Diubah');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\JurnalAgendaKelas;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RekapJurnalAgendaKelasController extends Controller
{
    public function index()
    {
        $start_date = '';
        $end_date   = '';
        $kelas      = '';
        $jurnal     = JurnalAgendaKelas::whereDate('tanggal', Carbon::today())->get();
        return view('admin.rekapJurnal', compact('jurnal', 'kelas', 'start_date', 'end_date'));
    }
    public function filter(Request $request)
    {
        $start_date = Carbon::parse($request->input('start_date'));
        $end_date   = Carbon::parse($request->input('end_date'));
        $kelas      = $request->kelas;
        $jurnal     = JurnalAgendaKelas::whereBetween('tanggal', [$start_date, $end_date])->when($kelas, function ($query) use ($kelas) {
            return $query->where('kelas', $kelas);
        })->get();
        return view('admin.rekapJurnal', compact('jurnal', 'kelas', 'start_date', 'end_date'));
    }
}

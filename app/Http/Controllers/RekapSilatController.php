<?php

namespace App\Http\Controllers;

use App\Models\Silat;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RekapSilatController extends Controller
{
    public function index()
    {
        $start_date = '';
        $end_date = '';
        $silat = Silat::whereDate('tanggal', Carbon::today())->get();
        return view('admin.rekapSilat', compact('silat', 'start_date', 'end_date'));
    }
    public function filter(Request $request)
    {
        $start_date = Carbon::parse($request->input('start_date'));
        $end_date = Carbon::parse($request->input('end_date'));
        $silat = Silat::whereBetween('tanggal', [$start_date, $end_date])->get();
        return view('admin.rekapSilat', compact('silat', 'start_date', 'end_date'));
    }
}

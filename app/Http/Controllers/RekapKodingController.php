<?php

namespace App\Http\Controllers;

use App\Models\Koding;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RekapKodingController extends Controller
{
    public function index()
    {
        $start_date = '';
        $end_date = '';
        $koding = Koding::whereDate('tanggal', Carbon::today())->get();
        return view('admin.rekapKoding', compact('koding', 'start_date', 'end_date'));
    }
    public function filter(Request $request)
    {
        $start_date = Carbon::parse($request->input('start_date'));
        $end_date = Carbon::parse($request->input('end_date'));
        $koding = Koding::whereBetween('tanggal', [$start_date, $end_date])->get();
        return view('admin.rekapKoding', compact('koding', 'start_date', 'end_date'));
    }
}

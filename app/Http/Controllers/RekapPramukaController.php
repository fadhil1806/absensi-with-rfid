<?php

namespace App\Http\Controllers;

use App\Models\Pramuka;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RekapPramukaController extends Controller
{
    public function index()
    {
        $start_date = '';
        $end_date = '';
        $pramuka = Pramuka::whereDate('tanggal', Carbon::today())->get();
        return view('admin.rekapPramuka', compact('pramuka', 'start_date', 'end_date'));
    }
    public function filter(Request $request)
    {
        $start_date = Carbon::parse($request->input('start_date'));
        $end_date = Carbon::parse($request->input('end_date'));
        $pramuka = Pramuka::whereBetween('tanggal', [$start_date, $end_date])->get();
        return view('admin.rekapPramuka', compact('pramuka', 'start_date', 'end_date'));
    }
}

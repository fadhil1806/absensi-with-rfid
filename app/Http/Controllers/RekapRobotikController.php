<?php

namespace App\Http\Controllers;

use App\Models\Robotik;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RekapRobotikController extends Controller
{
    public function index()
    {
        $start_date = '';
        $end_date = '';
        $robotik = Robotik::whereDate('tanggal', Carbon::today())->get();
        return view('admin.rekapRobotik', compact('robotik', 'start_date', 'end_date'));
    }
    public function filter(Request $request)
    {
        $start_date = Carbon::parse($request->input('start_date'));
        $end_date = Carbon::parse($request->input('end_date'));
        $robotik = Robotik::whereBetween('tanggal', [$start_date, $end_date])->get();
        return view('admin.rekapRobotik', compact('robotik', 'start_date', 'end_date'));
    }
}

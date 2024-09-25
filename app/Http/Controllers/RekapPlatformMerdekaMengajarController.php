<?php

namespace App\Http\Controllers;

use App\Models\PlatformMerdekaMengajar;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RekapPlatformMerdekaMengajarController extends Controller
{
    public function index()
    {
        $start_date = '';
        $end_date = '';
        $platform = PlatformMerdekaMengajar::whereDate('tanggal', Carbon::today())->get();
        return view('admin.rekapPlatform', compact('platform', 'start_date', 'end_date'));
    }
    public function filter(Request $request)
    {
        $start_date = Carbon::parse($request->input('start_date'));
        $end_date = Carbon::parse($request->input('end_date'));
        $platform = PlatformMerdekaMengajar::whereBetween('tanggal', [$start_date, $end_date])->get();
        return view('admin.rekapPlatform', compact('platform', 'start_date', 'end_date'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Futsal;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RekapFutsalController extends Controller
{
    public function index()
    {
        $start_date = '';
        $end_date = '';
        $futsal = Futsal::whereDate('tanggal', Carbon::today())->get();
        return view('admin.rekapFutsal', compact('futsal', 'start_date', 'end_date'));
    }
    public function filter(Request $request)
    {
        $start_date = Carbon::parse($request->input('start_date'));
        $end_date = Carbon::parse($request->input('end_date'));
        $futsal = Futsal::whereBetween('tanggal', [$start_date, $end_date])->get();
        return view('admin.rekapFutsal', compact('futsal', 'start_date', 'end_date'));
    }
}

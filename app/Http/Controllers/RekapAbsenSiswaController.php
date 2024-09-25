<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Izin;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RekapAbsenSiswaController extends Controller
{
    public function index()
    {
        $start_date = '';
        $end_date = '';
        $kelas = '';
        $role = 'Siswa';
        $absensi = Absensi::whereDate('jam_masuk', Carbon::today())->whereNull('tendik_id')->whereHas('siswa', function ($query) use ($role) {
            $query->where('role', $role);
        })->get();
        $izin = Izin::whereDate('updated_at', Carbon::today())->get();
        return view('admin.rekapSiswa', compact('absensi', 'izin', 'start_date', 'end_date', 'kelas'));
    }
    public function filter(Request $request)
    {
        $start_date = Carbon::parse($request->input('start_date'));
        $end_date   = Carbon::parse($request->input('end_date'));
        $kelas      = $request->kelas;
        $role       = 'Siswa';
        $rowTableAbsensi = Absensi::whereBetween('created_at', [$start_date, $end_date])->whereNull('tendik_id')->whereHas('siswa', function ($query) use ($kelas) {
            $query->where('kelas', $kelas);
        })->distinct('siswa_id')->get(['siswa_id']);
        $absensi = Absensi::whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date)->whereNull('tendik_id')
            ->whereHas('siswa', function ($query) use ($kelas) {
                $query->where('kelas', $kelas);
            })->get();
        $izin = Izin::whereBetween('created_at', [$start_date, $end_date])->whereHas('siswa', function ($query) use ($role) {
            $query->where('role', $role);
        })->whereHas('siswa', function ($query) use ($kelas) {
            $query->where('kelas', $kelas);
        })->get();
        $loopTanggal = [];
        $currentDate = $start_date->copy();
        while ($currentDate <= $end_date) {
            $loopTanggal[] = [
                'date' => $currentDate->copy()->toDateString(),
                'day' => $currentDate->copy()->format('d'),
                'name_siswa' => $absensi->pluck('siswa.nama')->unique()->toArray()
            ];
            $currentDate->addDay();
        }

        return view('admin.rekapSiswa', compact('absensi', 'izin', 'start_date', 'end_date', 'rowTableAbsensi', 'loopTanggal', 'kelas'));
    }
}

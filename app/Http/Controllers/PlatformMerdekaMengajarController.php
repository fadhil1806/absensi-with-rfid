<?php

namespace App\Http\Controllers;

use App\Models\Tendik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Models\PlatformMerdekaMengajar;
use App\Http\Requests\PlatformMerdekaMengajarRequest;

class PlatformMerdekaMengajarController extends Controller
{
    public function index()
    {
        $platform = PlatformMerdekaMengajar::orderBy('created_at', 'desc')->paginate(10);
        $tendik = Tendik::get();
        return view('admin.platformMerdekaMengajar', compact('platform', 'tendik'));
    }
    public function store(PlatformMerdekaMengajarRequest $request)
    {
        $request->validated();

        try {
            $sertifikatName = time() . '.' . $request->sertifikat->extension();
            $request->sertifikat->move(public_path('img/foto'), $sertifikatName);

            DB::transaction(function () use ($request, $sertifikatName) {
                PlatformMerdekaMengajar::create([
                    'tendik_id'    => $request->tendik_id,
                    'topik'        => $request->topik,
                    'tanggal'      => $request->tanggal,
                    'jam_mulai'    => $request->jam_mulai,
                    'jam_berakhir' => $request->jam_berakhir,
                    'hasil'        => $request->hasil,
                    'sertifikat'   => $sertifikatName,
                ]);
            });
            return redirect()->to('/platform')->with('success', 'Data Platform Berhasil Dibuat');
        } catch (\Throwable $th) {
            report($th);
            return redirect()->to('/platform')->with('error', 'Data Platform Berhasil Dibuat');
        }
    }
    public function edit($id)
    {
        $platform = PlatformMerdekaMengajar::findOrFail($id);
        return view('admin.platformMerdekaMengajar', compact('platform'));
    }
    public function update(PlatformMerdekaMengajarRequest $request, $id)
    {
        $validatedData = $request->validated();

        try {
            DB::beginTransaction();

            $platform = PlatformMerdekaMengajar::findOrFail($id);
            $platform->update($validatedData);

            if ($request->hasFile('sertifikat')) {
                $path = "img/foto/";
                File::delete($path . $platform->sertifikat);

                $sertifikatName = time() . '.' . $request->sertifikat->extension();
                $request->sertifikat->move(public_path('img/foto'), $sertifikatName);

                $platform->sertifikat = $sertifikatName;
            }

            $platform->save();

            DB::commit();

            return redirect('/platform')->with('success', 'Data Platform Berhasil Diperbarui');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect('/platform')->with('error', 'Terjadi kesalahan saat memperbarui data Platform: ' . $th->getMessage());
        }


        if ($request->has('sertifikat')) {

            $path = "img/sertifikat/";
            File::delete($path . $platform->sertifikat);

            $sertifikatName = time() . '.' . $request->sertifikat->extension();

            $request->sertifikat->move(public_path('img/sertifikat'), $sertifikatName);

            PlatformMerdekaMengajar::findOrFail($id)->update([
                'tendik_id'    => $request->tendik_id,
                'topik'        => $request->topik,
                'tanggal'      => $request->tanggal,
                'jam_mulai'    => $request->jam_mulai,
                'jam_berakhir' => $request->jam_berakhir,
                'hasil'        => $request->hasil,
                'sertifikat'   => $sertifikatName,
            ]);

            return redirect('/platform');
        } else {
            PlatformMerdekaMengajar::findOrFail($id)->update([
                'tendik_id'    => $request->tendik_id,
                'topik'        => $request->topik,
                'tanggal'      => $request->tanggal,
                'jam_mulai'    => $request->jam_mulai,
                'jam_berakhir' => $request->jam_berakhir,
                'hasil'        => $request->hasil,
                'sertifikat'   => $sertifikatName,
            ]);

            return redirect()->to('/platform')->with('success', 'Data Platform Berhasil Diperbarui');
        }
    }
    public function destroy($id)
    {
        PlatformMerdekaMengajar::findOrFail($id)->delete();
        return redirect()->to('/platform')->with('success', 'Data Platform Berhasil Dihapus');
    }
}

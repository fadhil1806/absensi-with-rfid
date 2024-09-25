<?php

namespace App\Http\Controllers;

use App\Models\DataCard;
use App\Models\DataCardAlert;
use App\Models\Siswa;
use App\Models\Tendik;
use Illuminate\Http\Request;

class DataCardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function indexSiswa()
    {
        // Mendapatkan semua data kartu
        $data = DataCard::where('status', 'siswa')->with('siswa')->get();
        return view('card.index', data: compact('data'));
    }

    public function indexTendik()
    {
        // Mendapatkan semua data kartu
        $data = DataCard::where('status', operator: 'tendik')->with('tendik')->get();
        return view('card.index-tendik', data: compact('data'));
    }


    public function edit()
    {
        // Mendapatkan semua data kartu
        return view(view: 'card.add-data');
    }

    public function addAlert( $id) {
        $data = DataCardAlert::findOrFail($id);
        return view('card.add-data-alert', data: compact('data'));
    }

    public function indexAlert()
    {
        $data = DataCardAlert::all();
        return view('card.index-alert', data: compact('data'));
    }


    public function getSiswa()
    {
        $siswa = Siswa::all(); // Ambil semua data siswa
        return response()->json($siswa); // Kembalikan sebagai JSON
    }

    public function getTendik()
    {
        $tendik = Tendik::all(); // Ambil semua data tendik
        return response()->json($tendik); // Kembalikan sebagai JSON
    }

    public function addDataCard(Request $request) {
        // dd($request->all());
        $request->validate([
            'card_id' => 'required|string|max:100',
            'data_id' => 'required',
            'status' => 'required|in:siswa,tendik', // Memastikan hanya 'siswa' atau 'tendik'
        ]);
    
        try {
            if ($request->status === 'siswa') {
                DataCard::create([
                    'card_id' => $request->card_id,
                    'status' => 'siswa',
                    'siswa_id' => $request->data_id,
                ]);
            } else {
                DataCard::create([
                    'card_id' => $request->card_id,
                    'status' => 'tendik',
                    'tendik_id' => $request->data_id,
                ]);
            }
    
            return response()->json([
                'message' => 'Data kartu berhasil disimpan.',
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menyimpan data: ' . $e->getMessage(),
            ], 500);
        }
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'id' => 'required|string|max:100',
        ]);

        $card_id = $request->id;
        $existingCard = DataCard::where('card_id', $card_id)->first();

        // Cek apakah kartu sudah ada
        if (!$existingCard) {
            DataCardAlert::create([
                'card_id' => $card_id,
                'status' => 'tidak terdaftar'
            ]);
            return response()->json([
                'message' => 'Data dengan card_id ini sudah ada.'
            ], 400);
        }

        // Menyimpan data kartu baru jika tidak ada
        $dataCard = DataCard::create([
            'card_id' => $card_id,
            // Tambahkan kolom lain sesuai kebutuhan dari input
        ]);

        return response()->json([
            'message' => 'Data kartu berhasil disimpan.',
            'data' => $dataCard
        ], 201);
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Menampilkan data kartu berdasarkan ID
        $dataCard = DataCard::findOrFail($id);
        return response()->json($dataCard);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'card_id' => 'string|max:100',
            'tendik_id' => 'exists:tendik,id',
            'siswa_id' => 'exists:siswa,id',
            'status' => 'in:tendik,siswa',
        ]);

        // Mengupdate data kartu
        $dataCard = DataCard::findOrFail($id);
        $dataCard->update($request->all());
        return response()->json($dataCard);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Menghapus data kartu
        $dataCard = DataCard::findOrFail($id);
        $dataCard->delete();
        return response()->json(null, 204);
    }
}

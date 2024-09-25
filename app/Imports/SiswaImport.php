<?php

namespace App\Imports;

use App\Models\Siswa;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\ToCollection;

class SiswaImport implements ToCollection, ToModel
{
    private $current = 0;
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        //
    }
    public function model(array $row)
    {
        $this->current++;
        if ($this->current > 1) {
            $row = array_map('trim', $row);

            if (is_numeric($row[6])) {
                $row[6] = Date::excelToDateTimeObject($row[6])->format('Y-m-d');
            }
            $check = Siswa::where('nisn', $row[1])->count();
            if (empty($check)) {
                Siswa::create([
                    'nisn'              => $row[1],
                    'nama'              => $row[2],
                    'kelas'             => $row[3],
                    'jenis_kelamin'     => $row[4],
                    'tempat_lahir'      => $row[5],
                    'tanggal_lahir'     => $row[6],
                    'role'              => $row[7],
                    'nomor_whatsapp'    => $row[8],
                    'foto'              => null,
                ]);
            }
        }
    }
}

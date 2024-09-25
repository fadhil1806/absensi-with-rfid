<?php

namespace App\Imports;

use App\Models\Tendik;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\ToCollection;

class TendikImport implements ToCollection, ToModel
{
    private $current = 0;
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
    }

    public function model(array $row)
    {
        $this->current++;
        if ($this->current > 1) {
            $row = array_map('trim', $row);

            if (is_numeric($row[6])) {
                $row[6] = Date::excelToDateTimeObject($row[6])->format('Y-m-d');
            }
            $check = Tendik::where('nik', $row[1])->count();
            if (empty($check)) {
                Tendik::create([
                    'nik'               => $row[1],
                    'nama'              => $row[2],
                    'jenis_kelamin'     => $row[3],
                    'tempat_lahir'      => $row[4],
                    'tanggal_lahir'     => $row[5],
                    'role'              => $row[6],
                    'jam_masuk'         => $row[7],
                    'jam_pulang'        => $row[8],
                    'nomor_whatsapp'    => $row[9],
                    'foto'              => null,
                ]);
            }
        }
    }
}

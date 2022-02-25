<?php

namespace App\Imports;

use App\Models\Data;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\ToCollection;

class UsersImport implements ToModel, WithStartRow, WithCustomCsvSettings
{
    public function startRow(): int
    {
        return 2;
    }

    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ','
        ];
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Data([
			'nik' => $row[0],
			'nama' => $row[1],
			'tempat_lahir' => $row[2],
			'tgl_lahir' => $row[3],
			'jenis_kelamin' => $row[4],
			'gol_darah' => $row[5],
			'alamat' => $row[6],
			'rt' => $row[7],
			'rw' => $row[8],
			'kelurahan' => $row[9],
			'kecamatan' => $row[10],
			'agama' => $row[11],
			'status' => $row[12],
			'pekerjaan' => $row[13],
			'kewarganegaraan' => $row[14]
        ]);
    }
} 
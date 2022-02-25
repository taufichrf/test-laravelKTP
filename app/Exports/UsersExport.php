<?php

namespace App\Exports;

use App\Models\Data;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithCustomCsvSettings, WithHeadings
{
    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ','
        ];
    }

    public function headings(): array
    {
        return ["NIK", "Nama", "Tempat Lahir", "Tanggal Lahir", "Jenis Kelamin", "Golongan Darah", "Alamat", "RT", "RW", "Kelurahan", "Kecamatan", "Agama", "Status", "Pekerjaan", "Kewarganegaraan"];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Data::select('nik', 'nama','tempat_lahir', 'tgl_lahir', 'jenis_kelamin', 'gol_darah', 'alamat', 'rt', 'rw', 'kelurahan', 'kecamatan', 'agama', 'status', 'pekerjaan', 'kewarganegaraan')->get();
    }
}
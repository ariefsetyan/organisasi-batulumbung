<?php

namespace App\Imports;
use App\Models\ExcelAbsensi;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AbsensiImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    *@return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
//dd($row);
        $excel_absensi = [
            // 'anggota_id'    => $row['ANGGOTA ID'],
            // 'nama'          => $row['NAMA'],
            // 'nama_kegiatan' => $row['NAMA KEGIATAN'],
            // 'tanggal'       => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['TANGGAL']),
            // 'jenis'         => $row['JENIS'],
            // 'status'        => $row['STATUS']
            'anggota_id'        => $row['anggota_id'],
            'nama'              => $row['nama'],
            // 'nama_kegiatan' => $row['nama_kegiatan'],
            // 'tanggal'       => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tanggal']),
            // 'jenis'         => $row['jenis'],
            'status'            => $row['status']
        ];
//dd($excel_absensi);
        return new ExcelAbsensi($excel_absensi);
    }
}

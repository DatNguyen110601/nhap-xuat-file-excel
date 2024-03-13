<?php

namespace App\Imports;

use App\Models\ThongTinUngVien;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class ThongTinUngVienImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $value = $row[1];
        $formatThongTinUngVien = Carbon::instance(Date::excelToDateTimeObject($value));
        return ThongTinUngVien::create([
            'ho_ten' => $row[0],
            'ngay_sinh'=> $formatThongTinUngVien,
            'vi_tri'=> $row[2],
            'dien_thoai'=> $row[3],
            'so_zalo'=> $row[4],
            'email'=> $row[5],
            'trinh_do'=> $row[6],
            'dia_chi'=> $row[7],
            'url_cv' => $row[8],
            'nguon'=> $row[9]
        ]);
    }
}

<?php

namespace App\Traits;

use Carbon\Carbon;
use App\Models\ThongTinUngVien;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ThongTinUngVienImport;
use Illuminate\Support\Facades\Config;
use PhpOffice\PhpSpreadsheet\Shared\Date;

trait NhapFileExcelTraits
{
    //
    public function importExcel($file){
        $data = Excel::toArray(new ThongTinUngVienImport ,$file);
        unset($data[0][0] , $data[0][1]);
        // dd($data[0][2]);

        foreach($data[0] as $row){
            $colNotNull = $this->ktRow($row);
            $value = $row[1];
            $formatThongTinUngVien = Carbon::instance(Date::excelToDateTimeObject($value));
            // format mm/dd/yyyy
            $formattedDate = $formatThongTinUngVien->format('m/d/Y');

            if($colNotNull){
                ThongTinUngVien::create([
                    'ho_ten' => $row[0],
                    'ngay_sinh'=> $formattedDate,
                    'vi_tri'=> $row[2],
                    'dien_thoai'=> $row[3],
                    'so_zalo'=> $row[4],
                    'email'=> $row[5],
                    'trinh_do'=> $row[6],
                    'dia_chi'=> $row[7],
                    'url_cv' => $row[8],
                    'nguon'=> $row[9]
                    ]);
            };
        }
    }

    // kt cột excel có null k
    private function ktRow($row){
        foreach($row as $col){
            if($col == null){
                return false;
            }
        }
        return true;
    }
}

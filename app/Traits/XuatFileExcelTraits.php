<?php

namespace App\Traits;

use App\Models\ThongTinUngVien;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ThongTinUngVienExport;
use Illuminate\Support\Facades\Config;

trait XuatFileExcelTraits
{
    public function exportExcel($thongTinUngVien){
        return Excel::download(new ThongTinUngVienExport($thongTinUngVien) , 'thongtinungvien.xlsx');;
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ThongTinUngVien;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ThongTinUngVienExport;
use App\Traits\XuatFileExcelTraits;

class ExportController extends Controller
{
    use XuatFileExcelTraits;
    public function export()
    {
        $thongTinUngVien = ThongTinUngVien::all();
        return $this->exportExcel($thongTinUngVien);
    }
}

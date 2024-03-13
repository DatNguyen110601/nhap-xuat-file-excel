<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\NhapFileExcelTraits;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ThongTinUngVienImport;

class FileExcelController extends Controller
{
    use NhapFileExcelTraits;

    public function create(){
        return view('create');
    }

    public function store(Request $request){
        $this->importExcel($request->file('file_excel'));

        // unset($data[0][0] , $data[0][1]);
        return redirect()->route('create');
    }
}

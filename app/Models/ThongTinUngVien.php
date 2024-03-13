<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThongTinUngVien extends Model
{
    use HasFactory;

    public $table = 'data___thong_tin_ung_vien';

    public $fillable = [
        'ho_ten',
        'ngay_sinh',
        'vi_tri',
        'dien_thoai',
        'so_zalo',
        'email',
        'trinh_do',
        'dia_chi',
        'url_cv',
        'nguon'
    ];
}

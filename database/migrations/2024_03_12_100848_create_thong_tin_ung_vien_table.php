<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThongTinUngVienTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data___thong_tin_ung_vien', function (Blueprint $table) {
            $table->unsignedInteger('id')->autoIncrement();
            $table->string('ho_ten');
            $table->string('ngay_sinh');
            $table->string('vi_tri');
            $table->string('dien_thoai');
            $table->string('so_zalo');
            $table->string('email');
            $table->string('trinh_do');
            $table->text('dia_chi');
            $table->text('url_cv')->nullable();
            $table->string('nguon');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data___thong_tin_ung_vien');
    }
}

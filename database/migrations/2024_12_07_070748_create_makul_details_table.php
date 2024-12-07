<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMakulDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('makul', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->unique(); // Kode mata kuliah
            $table->string('nama'); // Nama mata kuliah
            $table->integer('sks'); // Jumlah SKS
            $table->string('semester'); // Semester
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('makul');
    }
}

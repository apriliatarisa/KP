<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('surat_keluar', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user'); // id_user sebagai foreign key
            $table->string('tujuan_surat');
            $table->string('no_surat');
            $table->date('tgl_terbit')->nullable();
            $table->text('isi');
            $table->string('file_path')->nullable();
            $table->string('pengirim');
            $table->timestamps();

            // Menambahkan foreign key constraint
            $table->foreign('id_user')->references('id')->on('users'); // Sesuaikan dengan nama tabel user Anda
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_keluar');
    }
};

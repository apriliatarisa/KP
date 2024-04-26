<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisposisiSmTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disposisi_sm', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_user'); // Foreign key ke tabel users (many-to-one)
            $table->unsignedBigInteger('id_surat_masuk'); // Foreign key ke tabel surat_masuk (one-to-one)
            $table->text('tujuan'); // User yang akan dikirim disposisi
            $table->text('catatan'); // Pesan untuk user yang dituju
            $table->timestamps();

            // Tambahkan foreign key constraint
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_surat_masuk')->references('id')->on('surat_masuk')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('disposisi_sm');
    }
}

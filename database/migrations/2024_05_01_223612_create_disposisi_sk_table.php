<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisposisiSkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disposisi_sk', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_surat_keluar');
            $table->unsignedBigInteger('id_user'); // Pengirim disposisi
            $table->text('tujuan');
            $table->text('catatan')->nullable();
            $table->boolean('status')->default(false); // Default value is unread
            $table->timestamps();

            // Foreign keys
            $table->foreign('id_surat_keluar')->references('id')->on('surat_keluar')->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('disposisi_sk');
    }
}

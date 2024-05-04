<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgendaTable extends Migration
{
    /**
     * Jalankan migrasi.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agenda', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_surat_masuk')->nullable();
            $table->unsignedBigInteger('id_surat_keluar')->nullable();
            $table->string('no_agenda_sm'); // Nomor urut berdasarkan id surat masuk
            $table->string('surat_masuk'); // No_surat dari tabel surat masuk
            $table->string('no_agenda_sk'); // Nomor urut berdasarkan id surat keluar
            $table->string('surat_keluar'); // No_surat dari tabel surat keluar
            $table->timestamps();
        });
    }

    /**
     * Rollback migrasi.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agenda');
    }
}

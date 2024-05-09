<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiwayatSuratTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riwayat_surat', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_surat');
            $table->enum('jenis_surat', ['surat_masuk', 'surat_keluar']);
            $table->string('petugas');
            $table->unsignedBigInteger('id_surat_masuk')->nullable();
            $table->unsignedBigInteger('id_surat_keluar')->nullable();
            $table->timestamps();
            
            // Menambahkan foreign keys
            $table->foreign('id_surat_masuk')->references('id')->on('surat_masuk')->onDelete('cascade');
            $table->foreign('id_surat_keluar')->references('id')->on('surat_keluar')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('riwayat_surat');
    }
}

<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPenerimaToSuratMasukTable extends Migration
{
    public function up()
    {
        Schema::table('surat_masuk', function (Blueprint $table) {
            $table->unsignedBigInteger('id_user_penerima')->nullable();
            $table->foreign('id_user_penerima')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('surat_masuk', function (Blueprint $table) {
            $table->dropForeign(['id_user_penerima']);
            $table->dropColumn('id_user_penerima');
        });
    }
}

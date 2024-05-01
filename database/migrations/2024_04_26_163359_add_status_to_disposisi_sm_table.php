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
        Schema::table('disposisi_sm', function (Blueprint $table) {
            $table->boolean('status')->default(false); // Status disposisi: false (belum selesai), true (selesai)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('disposisi_sm', function (Blueprint $table) {
            //
        });
    }
};

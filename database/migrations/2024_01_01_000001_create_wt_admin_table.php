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
        Schema::create('wt_admin', function (Blueprint $table) {
            $table->id('id_admin');
            $table->string('nama_admin');
            $table->string('foto_admin')->nullable();
            $table->string('level_admin');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wt_admin');
    }
};

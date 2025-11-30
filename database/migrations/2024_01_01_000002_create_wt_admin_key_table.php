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
        Schema::create('wt_admin_key', function (Blueprint $table) {
            $table->unsignedBigInteger('id_admin')->primary();
            $table->string('username');
            $table->string('adminpass');

            $table->foreign('id_admin')->references('id_admin')->on('wt_admin')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wt_admin_key');
    }
};

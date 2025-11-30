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
        Schema::create('wt_reset_pass', function (Blueprint $table) {
            $table->id('id_reset');
            $table->unsignedBigInteger('id_user');
            $table->string('token');
            $table->dateTime('expired');

            $table->foreign('id_user')->references('id_user')->on('wt_user')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wt_reset_pass');
    }
};

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
        Schema::create('wt_user', function (Blueprint $table) {
            $table->id('id_user');
            $table->string('no_id')->nullable();
            $table->string('username')->unique();
            $table->string('nama_user');
            $table->string('foto_user')->nullable();
            $table->string('email')->unique();
            $table->string('hp')->nullable();
            $table->string('nama_bank')->nullable();
            $table->string('rek_bank')->nullable();
            $table->string('referral')->nullable();
            $table->unsignedBigInteger('id_user_referral')->nullable();
            $table->string('acc_status')->default('pending');
            $table->string('status_suspend')->default('active');
            $table->string('wd_status')->default('enabled');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wt_user');
    }
};

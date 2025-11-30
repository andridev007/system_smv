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
        Schema::create('wt_withdraw_req', function (Blueprint $table) {
            $table->id('id_req');
            $table->unsignedBigInteger('id_wd');
            $table->string('status_req')->default('pending');
            $table->string('receipt')->nullable();

            $table->foreign('id_wd')->references('id_wd')->on('wt_withdraw')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wt_withdraw_req');
    }
};

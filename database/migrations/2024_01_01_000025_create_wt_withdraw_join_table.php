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
        Schema::create('wt_withdraw_join', function (Blueprint $table) {
            $table->id('id_wd_join');
            $table->unsignedBigInteger('id_wd');
            $table->unsignedBigInteger('id_join');
            $table->decimal('nominal_wd', 15, 2);
            $table->string('sumber')->nullable();

            $table->foreign('id_wd')->references('id_wd')->on('wt_withdraw')->onDelete('cascade');
            $table->foreign('id_join')->references('id_join')->on('wt_join')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wt_withdraw_join');
    }
};

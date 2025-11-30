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
        Schema::create('wt_mutual', function (Blueprint $table) {
            $table->id('id_mutual');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('investor');
            $table->unsignedBigInteger('trader');
            $table->decimal('nominal_investor', 15, 2);
            $table->decimal('nominal_trader', 15, 2);
            $table->dateTime('tgl_join');
            $table->string('status_mutual')->default('pending');

            $table->foreign('id_user')->references('id_user')->on('wt_user')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wt_mutual');
    }
};

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
        Schema::create('wt_join_confirm', function (Blueprint $table) {
            $table->id('id_confirm');
            $table->unsignedBigInteger('id_join');
            $table->string('status_confirm')->default('pending');
            $table->string('receipt')->nullable();

            $table->foreign('id_join')->references('id_join')->on('wt_join')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wt_join_confirm');
    }
};

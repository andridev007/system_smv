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
        Schema::create('wt_referral', function (Blueprint $table) {
            $table->id('id_referral');
            $table->unsignedBigInteger('id_join');
            $table->unsignedBigInteger('dari_user_referral');
            $table->unsignedBigInteger('untuk_user_referral');
            $table->integer('level_referral');
            $table->decimal('persen_referral', 10, 4);
            $table->decimal('nominal_referral', 15, 2);

            $table->foreign('id_join')->references('id_join')->on('wt_join')->onDelete('cascade');
            $table->foreign('dari_user_referral')->references('id_user')->on('wt_user')->onDelete('cascade');
            $table->foreign('untuk_user_referral')->references('id_user')->on('wt_user')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wt_referral');
    }
};

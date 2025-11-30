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
            $table->string('id_referral', 36)->primary();
            $table->string('id_user', 36);
            $table->string('id_referred_user', 36);
            $table->double('bonus_amount', 15, 2)->default(0);
            $table->double('commission_percentage', 5, 2)->default(0);
            $table->integer('level')->default(1);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->datetime('created_at')->nullable();
            $table->datetime('updated_at')->nullable();

            $table->foreign('id_user')->references('id_user')->on('wt_user')->onDelete('cascade');
            $table->foreign('id_referred_user')->references('id_user')->on('wt_user')->onDelete('cascade');
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

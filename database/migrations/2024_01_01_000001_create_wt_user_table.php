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
            $table->string('id_user', 36)->primary();
            $table->string('username', 100)->unique();
            $table->string('password', 255);
            $table->string('email', 255)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('full_name', 255)->nullable();
            $table->string('referral_code', 50)->nullable()->unique();
            $table->string('referred_by', 36)->nullable();
            $table->double('balance', 15, 2)->default(0);
            $table->enum('status', ['active', 'inactive', 'suspended'])->default('active');
            $table->datetime('created_at')->nullable();
            $table->datetime('updated_at')->nullable();

            $table->foreign('referred_by')->references('id_user')->on('wt_user')->onDelete('set null');
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

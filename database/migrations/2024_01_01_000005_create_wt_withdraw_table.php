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
        Schema::create('wt_withdraw', function (Blueprint $table) {
            $table->string('id_withdraw', 36)->primary();
            $table->string('id_user', 36);
            $table->double('amount', 15, 2)->default(0);
            $table->double('fee', 15, 2)->default(0);
            $table->double('net_amount', 15, 2)->default(0);
            $table->string('bank_name', 100)->nullable();
            $table->string('account_number', 50)->nullable();
            $table->string('account_name', 255)->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected', 'completed'])->default('pending');
            $table->datetime('request_date')->nullable();
            $table->datetime('processed_date')->nullable();
            $table->datetime('created_at')->nullable();
            $table->datetime('updated_at')->nullable();

            $table->foreign('id_user')->references('id_user')->on('wt_user')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wt_withdraw');
    }
};

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
        Schema::create('wt_profit_share', function (Blueprint $table) {
            $table->string('id_profit_share', 36)->primary();
            $table->string('id_join', 36);
            $table->string('id_user', 36);
            $table->double('amount', 15, 2)->default(0);
            $table->double('percentage', 5, 2)->default(0);
            $table->enum('status', ['pending', 'paid', 'cancelled'])->default('pending');
            $table->datetime('profit_date')->nullable();
            $table->datetime('created_at')->nullable();
            $table->datetime('updated_at')->nullable();

            $table->foreign('id_join')->references('id_join')->on('wt_join')->onDelete('cascade');
            $table->foreign('id_user')->references('id_user')->on('wt_user')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wt_profit_share');
    }
};

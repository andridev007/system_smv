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
        Schema::create('investments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('type', ['daily', 'dream']);
            $table->decimal('amount', 15, 2);
            $table->decimal('license_fee', 15, 2);
            $table->integer('unique_code');
            $table->decimal('total_transfer', 15, 2);
            $table->enum('status', ['pending', 'active', 'rejected', 'completed'])->default('pending');
            $table->string('proof_image')->nullable();
            $table->timestamp('effective_date')->nullable();
            $table->decimal('active_balance', 15, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('investments');
    }
};

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
            $table->decimal('effective_balance', 15, 2);
            $table->decimal('total_earned', 15, 2)->default(0);
            $table->enum('status', ['pending', 'active', 'completed', 'rejected'])->default('pending');
            $table->string('proof_file')->nullable();
            $table->boolean('is_auto_compound')->default(false);
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

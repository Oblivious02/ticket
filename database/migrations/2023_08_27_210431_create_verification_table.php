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
        Schema::create('verifications', function (Blueprint $table) {
            $table->id();
            $table->string('phone', 50)->nullable();
            $table->string('email', 50)->nullable();
            $table->string('dial_code', 15);
            $table->boolean('verified')->default(false);
            $table->string('otp', 6)->nullable();
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamp('verified_at')->nullable();
            $table->string('token')->nullable();
            $table->integer('attempts')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('verifications');
    }
};

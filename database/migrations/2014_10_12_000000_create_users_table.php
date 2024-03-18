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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->unique();
            $table->string('gender')->nullable();
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->string('goal')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone')->nullable();
            $table->unsignedBigInteger('doctor_id')->nullable();
            $table->text('routine')->nullable();
            $table->text('medical_history')->nullable();
            $table->text('allergens')->nullable();
            $table->tinyInteger('is_super_admin')->nullable();
            $table->tinyInteger('is_dietician')->nullable();
            $table->tinyInteger('is_user')->nullable();
            $table->string('access_token')->nullable();
            $table->rememberToken();
            $table->timestamp('last_used_at')->nullable();
            $table->timestamp('date_of_birth')->nullable();
            $table->timestamps();
        });
    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

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
        Schema::create('reminders', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('car_id')->constrained('cars')->onDelete('cascade');
            $table->string('name', 15);
            $table->text('comment')->nullable();
            $table->enum('type', ['reminder', 'periodic'])->default('reminder');
            $table->date('date_of_exec');
            $table->enum('cycle', ['week', 'month', 'month3', 'month6', 'year'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reminders');
    }
};

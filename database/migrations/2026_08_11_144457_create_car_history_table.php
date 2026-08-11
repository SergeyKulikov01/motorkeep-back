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
        Schema::create('car_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('car_id')->constrained('cars')->onDelete('cascade');
            $table->string('name');
            $table->string('file_id')->nullable();
            $table->string('place')->nullable();
            $table->decimal('volume', 6, 2)->nullable();
            $table->unsignedInteger('mileage')->default(0);
            $table->unsignedInteger('price')->default(0);
            $table->date('date');
            $table->enum('type', ['service', 'repair', 'buy', 'fuel', 'note'])->nullable();
            $table->text('comment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_history');
    }
};

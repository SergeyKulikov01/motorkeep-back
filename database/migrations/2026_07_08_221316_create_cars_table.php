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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->constrained('brands')->onDelete('cascade');
            $table->foreignId('car_model_id')->constrained('car_models')->onDelete('cascade');
            $table->unsignedSmallInteger('year');
            $table->foreignId('body_type_id')->constrained('body_types')->onDelete('cascade');
            $table->string('color');
            $table->decimal('engine_volume', 3, 1);
            $table->enum('transmission_type', ['manual', 'automatic', 'robot', 'variator']);
            $table->string('vin', 17)->nullable()->unique();
            $table->string('plate_number', 9)->nullable();
            $table->string('plate_region', 3)->nullable();
            $table->unsignedInteger('mileage')->default(0);
            $table->text('comment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};

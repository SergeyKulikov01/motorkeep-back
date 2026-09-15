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
        Schema::create('user_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            //
            $table->enum('gender', ['male', 'female','unset'])->default('unset');
            $table->string('about', 200);
            $table->date('date_birth');
            $table->string('phone', 11);
            $table->integer('service_period')->default(7500);
            $table->integer('oil_period')->default(7500);
            $table->enum('change_tyre_notify', ['auto', 'manual','off'])->default('off');
            $table->date('summer_tyre');
            $table->date('winter_tyre');
            $table->boolean('notify_next_service')->default(true);
            $table->boolean('notify_oil_change')->default(true);
            $table->boolean('notify_tyres_change')->default(true);
            $table->boolean('notify_change_breakes')->default(true);
            $table->boolean('stats_week')->default(true);
            $table->boolean('stats_months')->default(true);
            $table->boolean('notify_email')->default(true);
            $table->boolean('notify_push')->default(false);
            $table->boolean('notify_telegram')->default(false);
            //
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};

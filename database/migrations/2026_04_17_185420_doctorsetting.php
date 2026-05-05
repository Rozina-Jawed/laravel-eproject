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
        Schema::create('doctor_settings', function (Blueprint $table) {
        $table->id();
        $table->integer('doctor_id');
        $table->boolean('availability_status')->default(1);
        $table->boolean('online_consultation')->default(1);
        $table->boolean('emergency_booking')->default(0);
        $table->boolean('sms_notifications')->default(1);
        $table->boolean('email_notifications')->default(0);
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::DropIfExists('doctor_settings'); 
    }
};

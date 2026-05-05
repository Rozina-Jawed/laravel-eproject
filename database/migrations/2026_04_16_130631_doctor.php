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
        Schema::create("doctor", function (Blueprint $table) {
         $table->id("doctor_id");
         $table->string("doctor_name");
         $table->string("doctor_age");
         $table->string("doctor_email")->unique();
         $table->string("doctor_password");
         $table->string("doctor_cv");
         $table->string("doctor_specialization");

         // 🔥 ONLY ADDED THIS (CITY)
         $table->unsignedBigInteger('city_id')->nullable();

         $table->foreign('city_id')
               ->references('id')
               ->on('care_cities')
               ->onDelete('set null');

         $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctor');
    }
};

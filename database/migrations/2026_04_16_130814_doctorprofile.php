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
        Schema::create("doctor_profile",function (Blueprint $table){
        $table->id("doctor_profile_id");
        $table ->foreignId("doctor_id")->constrained('doctor')->onDelete('cascade');
        $table->string("doctor_profile_image")->nullable();
        $table->string("doctor_hospital");
        $table->time("available_time");
        $table->json("available_day");
        $table->string("doctor_experience")->nullable();
        $table-> string("doctor_degree")->nullable();
        $table->enum("doctor_gender",['Male','Female'])->nullable();
        $table->string("doctor_phone_number", 22)->nullable();
        $table->integer("doctor_first_fee");
        $table->integer("doctor_sale_fee");
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       Schema::DropIfExists('doctor_profile'); 
    }
};

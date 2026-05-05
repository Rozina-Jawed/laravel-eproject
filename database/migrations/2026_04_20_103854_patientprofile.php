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
        Schema::create("patient_profile",function (Blueprint $table){
        $table->id("patient_profile_id");
        $table ->foreignId("patient_id")->constrained('patient')->onDelete('cascade');
        $table->string("patient_profile_image")->nullable();
        $table->enum("patient_gender",['Male','Female'])->nullable();
        $table->string("patient_phone_number", 22)->nullable();
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::DropIfExists('patient_profile'); 
    }
};

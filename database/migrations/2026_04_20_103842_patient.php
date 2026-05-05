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
      Schema::create('patient', function (Blueprint $table) {
            $table->id();
            $table->string('patient_name');
            $table->integer('patient_age');
            $table->string('patient_email')->unique();
            $table->string('patient_password');
            $table->timestamps();
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
                Schema::DropIfExists('patient');
    }
};

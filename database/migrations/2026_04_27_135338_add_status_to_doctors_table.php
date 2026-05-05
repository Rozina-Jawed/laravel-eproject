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
        Schema::table('doctor', function (Blueprint $table) {
               $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending')->after('doctor_specialization');
        });

        // Update existing doctors to 'approved'
        DB::table('doctor')->update(['status' => 'approved']);
    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('doctor', function (Blueprint $table) {
             $table->dropColumn('status');
        });
    }
};

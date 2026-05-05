<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('patient', function (Blueprint $table) {
            // ✅ Safe check - add status only if not exists
            if (!Schema::hasColumn('patient', 'status')) {
                $table->enum('status', ['pending', 'approved', 'active'])->default('active');
            }
        });
    }

    public function down(): void
    {
        Schema::table('patient', function (Blueprint $table) {
            if (Schema::hasColumn('patient', 'status')) {
                $table->dropColumn('status');
            }
        });
    }
};
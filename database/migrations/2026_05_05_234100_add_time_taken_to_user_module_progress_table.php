<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('user_module_progress', function (Blueprint $table) {
            $table->integer('time_taken')->nullable()->after('answers')->comment('Time in seconds');
        });
    }

    public function down(): void
    {
        Schema::table('user_module_progress', function (Blueprint $table) {
            $table->dropColumn('time_taken');
        });
    }
};

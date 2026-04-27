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
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->unique()->after('name');
            $table->string('email')->nullable()->change();
            $table->string('asal_instansi')->after('password'); // kampus/sekolah
            $table->string('negara')->after('asal_instansi');
            $table->string('avatar_path')->nullable()->after('negara');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['username', 'asal_instansi', 'negara', 'avatar_path']);
            $table->string('email')->nullable(false)->change();
        });
    }
};

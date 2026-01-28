<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Update existing data dulu
        DB::table('kendaraans')
            ->whereIn('tipe', ['bebek', 'Bebek', 'BEBEK', 'manual', 'MANUAL'])
            ->update(['tipe' => 'Manual']);
            
        DB::table('kendaraans')
            ->whereIn('tipe', ['matic', 'Matic', 'MATIC', 'Automatic'])
            ->update(['tipe' => 'Matic']);
            
        DB::table('kendaraans')
            ->whereIn('tipe', ['sport', 'Sport', 'SPORT'])
            ->update(['tipe' => 'Manual']); // Sport masuk Manual (motor kopling)

        // Ubah kolom jadi ENUM
        Schema::table('kendaraans', function (Blueprint $table) {
            $table->enum('tipe', ['Matic', 'Manual'])->default('Matic')->change();
        });
    }

    public function down(): void
    {
        Schema::table('kendaraans', function (Blueprint $table) {
            $table->string('tipe')->change();
        });
    }
};

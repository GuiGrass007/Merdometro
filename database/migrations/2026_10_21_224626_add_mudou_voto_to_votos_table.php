<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::table('votos', function (Blueprint $table) {
        $table->boolean('mudou_voto')->default(false);
    });
}

public function down(): void
{
    Schema::table('votos', function (Blueprint $table) {
        $table->dropColumn('mudou_voto');
    });
}
};

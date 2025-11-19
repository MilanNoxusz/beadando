<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('helysegek', function (Blueprint $table) {
            $table->integer('az')->primary();
            $table->string('nev');
            $table->string('orszag')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('helysegek');
    }
};

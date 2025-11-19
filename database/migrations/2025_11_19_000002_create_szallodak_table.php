<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('szallodak', function (Blueprint $table) {
            $table->string('az')->primary();
            $table->string('nev');
            $table->integer('besorolas')->nullable();
            $table->integer('helyseg_az')->nullable();
            $table->integer('tengerpart_tav')->nullable();
            $table->integer('repter_tav')->nullable();
            $table->boolean('felpanzio')->default(false);

            $table->foreign('helyseg_az')->references('az')->on('helysegek')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('szallodak');
    }
};

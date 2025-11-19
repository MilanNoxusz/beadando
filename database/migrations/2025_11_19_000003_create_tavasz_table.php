<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tavasz', function (Blueprint $table) {
            $table->id();
            $table->string('szalloda_az');
            $table->date('indulas');
            $table->integer('idotartam');
            $table->integer('ar');

            $table->foreign('szalloda_az')->references('az')->on('szallodak')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tavasz');
    }
};

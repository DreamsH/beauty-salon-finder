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
        Schema::create('salon_services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('external_id')->index();
            $table->foreignId('salon_id');
            $table->foreign('salon_id')->references('id')->on('salons')->cascadeOnDelete();
            $table->string('name')->index();
            $table->string('currency', 5);
            $table->string('display', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salon_services');
    }
};

<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('race_results', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('race_id')->constrained();
            $table->foreignId('status_id')->constrained();
            $table->foreignId('driver_id')->constrained();
            $table->foreignId('constructor_id')->constrained();
            $table->unsignedBigInteger('number')->nullable();
            $table->unsignedBigInteger('position');
            $table->unsignedBigInteger('points');
            $table->unsignedBigInteger('grid');
            $table->unsignedBigInteger('laps');
            $table->timestamps();
        });
    }
};
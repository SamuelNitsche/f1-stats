<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('sprint_qualifying_results', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('race_id')->constrained();
            $table->foreignId('driver_id')->constrained();
            $table->foreignId('constructor_id')->constrained();
            $table->unsignedInteger('number');
            $table->unsignedInteger('grid');
            $table->unsignedInteger('position')->nullable();
            $table->string('position_text');
            $table->unsignedInteger('position_order');
            $table->unsignedFloat('points');
            $table->unsignedInteger('laps');
            $table->string('time')->nullable();
            $table->unsignedInteger('milliseconds')->nullable();
            $table->unsignedInteger('fastest_lap')->nullable();
            $table->string('fastest_lap_time')->nullable();
            $table->foreignId('status_id')->constrained();
            $table->timestamps();
        });
    }
};

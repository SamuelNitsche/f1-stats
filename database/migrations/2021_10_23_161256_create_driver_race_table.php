<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('driver_race', function (Blueprint $table) {
            $table->foreignId('race_id')->constrained()->cascadeOnDelete();
            $table->foreignId('driver_id')->constrained()->cascadeOnDelete();
            $table->foreignId('round_id')->constrained()->cascadeOnDelete();
            $table->foreignId('track_id')->constrained()->cascadeOnDelete();
            $table->integer('position');
            $table->string('status');
            $table->integer('laps');
            $table->integer('total_time_millis')->nullable();
            $table->string('total_time')->nullable();
            $table->string('fastest_lap_time')->nullable();
            $table->integer('fastest_lap_number')->nullable();
            $table->integer('fastest_lap_rank')->nullable();
        });
    }
};

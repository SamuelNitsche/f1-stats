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
        Schema::create('lap_times', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('race_id')->constrained();
            $table->foreignId('driver_id')->constrained();
            $table->integer('lap_number');
            $table->integer('position');
            $table->string('time');
            $table->timestamps();
        });
    }
};

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
        Schema::create('races', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('season_id')->constrained();
            $table->foreignId('circuit_id')->constrained();
            $table->unsignedBigInteger('round');
            $table->string('name');
            $table->string('url');
            $table->dateTime('starts_at')->nullable();
            $table->dateTime('fp1_starts_at')->nullable();
            $table->dateTime('fp2_starts_at')->nullable();
            $table->dateTime('fp3_starts_at')->nullable();
            $table->dateTime('qualifying_starts_at')->nullable();
            $table->dateTime('sprint_starts_at')->nullable();
            $table->timestamps();
        });
    }
};

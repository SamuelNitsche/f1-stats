<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('rounds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('season_id')->constrained()->cascadeOnDelete();
            $table->foreignId('track_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->integer('round');
            $table->dateTime('date');
            $table->string('wikipedia_url');
            $table->timestamps();

            $table->unique(['season_id', 'track_id', 'round']);
        });
    }
};

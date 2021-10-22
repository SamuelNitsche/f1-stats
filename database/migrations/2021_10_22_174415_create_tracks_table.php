<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('tracks', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('name');
            $table->text('wikipedia_url');
            $table->string('lat');
            $table->string('lon');
            $table->string('locality');
            $table->string('country');
            $table->timestamps();
        });
    }
};

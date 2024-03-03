<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('drivers', function (Blueprint $table): void {
            $table->id();
            $table->string('slug');
            $table->string('url');
            $table->string('given_name');
            $table->string('family_name');
            $table->date('date_of_birth');
            $table->timestamps();
        });
    }
};

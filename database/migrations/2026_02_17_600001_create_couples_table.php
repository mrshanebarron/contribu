<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('couples', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('partner_one');
            $table->string('partner_two');
            $table->date('wedding_date');
            $table->string('venue')->nullable();
            $table->string('location')->nullable();
            $table->text('story')->nullable();
            $table->string('photo')->nullable();
            $table->string('cover_photo')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('couples');
    }
};

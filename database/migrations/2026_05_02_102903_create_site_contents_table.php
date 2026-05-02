<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('site_contents', function (Blueprint $table) {
            $table->id();
            $table->string('site_title')->default('Фалькин Роман — портфолио');
            $table->text('meta_description')->nullable();
            $table->string('og_image')->nullable();
            $table->string('hero_bg_image')->nullable();
            $table->string('avatar_image')->nullable();
            $table->json('home')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('site_contents');
    }
};

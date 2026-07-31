<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('name_en')->nullable();
            $table->string('role')->nullable();
            $table->string('role_en')->nullable();
            $table->string('role_mobile')->nullable();
            $table->string('role_mobile_en')->nullable();
            $table->text('body')->nullable();
            $table->text('body_en')->nullable();
            $table->string('avatar_image')->nullable();
            $table->unsignedTinyInteger('stars')->default(5);
            $table->boolean('show_in_avatars')->default(true);
            $table->boolean('is_published')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('name');
            $table->text('tagline')->nullable();
            $table->string('meta_client')->nullable();
            $table->string('meta_service')->nullable();
            $table->string('meta_date')->nullable();
            $table->longText('overview_p1')->nullable();
            $table->longText('overview_p2')->nullable();
            $table->json('features')->nullable();
            $table->longText('overview_p3')->nullable();
            $table->string('accent_line')->nullable();
            $table->string('live_url')->nullable();
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->string('card_image')->nullable();
            $table->string('logo_image')->nullable();
            $table->string('banner_image')->nullable();
            $table->json('gallery_images')->nullable();
            $table->boolean('is_published')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};

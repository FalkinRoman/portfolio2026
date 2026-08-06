<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->string('card_blurb', 180)->nullable()->after('tagline');
            $table->string('card_blurb_en', 180)->nullable()->after('tagline_en');
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn(['card_blurb', 'card_blurb_en']);
        });
    }
};

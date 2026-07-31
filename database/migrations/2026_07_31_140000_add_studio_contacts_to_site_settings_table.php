<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->string('social_whatsapp_url', 500)->nullable()->after('social_telegram_url');
            $table->string('contact_email', 255)->nullable()->after('social_whatsapp_url');
            $table->string('contact_phone', 64)->nullable()->after('contact_email');
            $table->string('studio_logo_path', 500)->nullable()->after('contact_phone');
            $table->string('studio_presentation_path', 500)->nullable()->after('studio_logo_path');
        });
    }

    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn([
                'social_whatsapp_url',
                'contact_email',
                'contact_phone',
                'studio_logo_path',
                'studio_presentation_path',
            ]);
        });
    }
};

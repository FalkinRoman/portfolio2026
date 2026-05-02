<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->string('name_en')->nullable()->after('name');
            $table->text('tagline_en')->nullable()->after('tagline');
            $table->string('meta_client_en')->nullable()->after('meta_client');
            $table->text('meta_service_en')->nullable()->after('meta_service');
            $table->string('meta_date_en')->nullable()->after('meta_date');
            $table->longText('overview_p1_en')->nullable()->after('overview_p1');
            $table->longText('overview_p2_en')->nullable()->after('overview_p2');
            $table->longText('overview_p3_en')->nullable()->after('overview_p3');
            $table->json('features_en')->nullable()->after('features');
            $table->text('accent_line_en')->nullable()->after('accent_line');
            $table->string('seo_title_en')->nullable()->after('seo_title');
            $table->text('seo_description_en')->nullable()->after('seo_description');
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn([
                'name_en', 'tagline_en', 'meta_client_en', 'meta_service_en', 'meta_date_en',
                'overview_p1_en', 'overview_p2_en', 'overview_p3_en', 'features_en',
                'accent_line_en', 'seo_title_en', 'seo_description_en',
            ]);
        });
    }
};

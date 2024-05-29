<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('incident_reports', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->text('synopsis')->nullable();

            $table->uuid('property_id')->nullable();
            $table->foreign('property_id')->references('id')->on('properties');

            $table->uuid('group_section_id')->nullable();
            $table->foreign('group_section_id')->references('id')->on('group_sections');

            $table->uuid('link_report')->nullable();
            $table->foreign('link_report')->references('id')->on('incident_reports');

            $table->uuid('report_status_id')->nullable();
            $table->foreign('report_status_id')->references('id')->on('report_statuses');

            $table->uuid('area_id')->nullable();
            $table->foreign('area_id')->references('id')->on('areas');

            $table->uuid('location_id')->nullable();
            $table->foreign('location_id')->references('id')->on('locations');

            $table->longText('description')->nullable();
            $table->date('event_date')->nullable();

            $table->uuid('department_id')->nullable();
            $table->foreign('department_id')->references('id')->on('departments');

            $table->uuid('report_type_id')->nullable();
            $table->foreign('report_type_id')->references('id')->on('report_types');

            $table->uuid('incident_title_id')->nullable();
            $table->foreign('incident_title_id')->references('id')->on('incident_titles');

            $table->uuid('origin_id')->nullable();
            $table->foreign('origin_id')->references('id')->on('originations');

            $table->uuid('result_id')->nullable();
            $table->foreign('result_id')->references('id')->on('results');

            $table->uuid('currency_id')->nullable();
            $table->foreign('currency_id')->references('id')->on('currencies');

            $table->decimal('total_value', 18, 4)->nullable();
            $table->longText('details')->nullable();
            $table->longText('action_taken')->nullable();

            $table->uuid('inspector_id')->nullable();
            $table->foreign('inspector_id')->references('id')->on('inspectors');

            $table->tinyInteger('for_head_reply')->default(0);

            $table->string('verified_by')->nullable();
            $table->timestamps();
            $table->uuid('created_by')->nullable();
            $table->uuid('updated_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incident_reports');
    }
};

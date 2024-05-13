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
        Schema::create('incident_blacklists', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->uuid('blacklist_id')->nullable();
            $table->foreign('blacklist_id')->references('id')->on('blacklists');
            $table->uuid('incident_report_id')->nullable();
            $table->foreign('incident_report_id')->references('id')->on('incident_reports');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incident_blacklists');
    }
};

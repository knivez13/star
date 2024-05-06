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
        Schema::create('briefing_logs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('origination_id')->nullable();
            $table->foreign('origination_id')->references('id')->on('originations');
            $table->uuid('group_section_id')->nullable();
            $table->foreign('group_section_id')->references('id')->on('group_sections');
            $table->longText('description');
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
        Schema::dropIfExists('briefing_logs');
    }
};

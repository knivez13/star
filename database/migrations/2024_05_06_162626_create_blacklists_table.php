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
        Schema::create('blacklists', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('member_id')->nullable();;
            $table->text('first_name');
            $table->text('middle_name')->nullable();
            $table->text('last_name');
            $table->uuid('blackist_status_id')->nullable();
            $table->foreign('blackist_status_id')->references('id')->on('blackist_statuses');
            $table->uuid('blackist_type_id')->nullable();
            $table->foreign('blackist_type_id')->references('id')->on('blackist_types');
            $table->date('date_hired')->nullable();

            $table->string('image_path')->nullable();
            $table->string('image_path2')->nullable();
            $table->string('image_path3')->nullable();

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
        Schema::dropIfExists('blacklists');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->uuid('department_id')->nullable();
            $table->uuid('user_level_id')->nullable();
            $table->uuid('user_designation_id')->nullable();
            $table->uuid('created_by')->nullable();
            $table->uuid('updated_by')->nullable();
            $table->foreign('department_id')->references('id')->on('departments');
            $table->foreign('user_level_id')->references('id')->on('user_levels');
            $table->foreign('user_designation_id')->references('id')->on('user_designations');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
        });
    }


    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_created_by_foreign');
            $table->dropForeign('users_updated_by_foreign');

            $table->dropForeign('users_department_id_foreign');
            $table->dropForeign('users_user_level_id_foreign');
            $table->dropForeign('users_user_designation_id_foreign');

            $table->dropColumn('department_id');
            $table->dropColumn('user_level_id');
            $table->dropColumn('user_designation_id');

            $table->dropColumn('created_by');
            $table->dropColumn('updated_by');
        });
    }
};

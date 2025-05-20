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
        Schema::table('novel_categories', function (Blueprint $table) {
            $table->renameColumn('name_th', 'name');
        });

        Schema::table('novels', function (Blueprint $table) {
            $table->renameColumn('title_th', 'title');
            $table->renameColumn('description_th', 'description');
        });

        Schema::table('chapters', function (Blueprint $table) {
            $table->renameColumn('title_th', 'title');
            $table->renameColumn('content_th', 'content');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('novel_categories', function (Blueprint $table) {
            $table->renameColumn('name', 'name_th');
        });

        Schema::table('novels', function (Blueprint $table) {
            $table->renameColumn('title', 'title_th');
            $table->renameColumn('description', 'description_th');
        });

        Schema::table('chapters', function (Blueprint $table) {
            $table->renameColumn('title', 'title_th');
            $table->renameColumn('content', 'content_th');
        });
    }
};

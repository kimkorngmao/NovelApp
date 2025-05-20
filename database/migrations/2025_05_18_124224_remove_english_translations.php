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
        Schema::table('novels', function (Blueprint $table) {
            $table->dropColumn(['title_en', 'description_en']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('novels', function (Blueprint $table) {
            $table->string('title_en')->nullable()->after('title_th');
            $table->text('description_en')->nullable()->after('description_th');
        });
    }
};

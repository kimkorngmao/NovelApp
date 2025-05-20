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
        Schema::create('novels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('novel_categories')->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title_th');
            $table->string('title_en')->nullable();
            $table->string('slug')->unique();
            $table->text('description_th');
            $table->text('description_en')->nullable();
            $table->string('cover_image')->nullable();
            $table->enum('type', ['short', 'series']);
            $table->enum('status', ['ongoing', 'completed'])->default('ongoing');
            $table->boolean('is_published')->default(false);
            $table->integer('views')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('novels');
    }
};

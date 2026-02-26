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
        Schema::create('featured_works', function (Blueprint $table) {
            $table->id();
            $table->string('title', 50);
            $table->string('link')->nullable();
            $table->string('image');
            $table->json('tag_ids')->nullable();
            $table->text('about_work');
            $table->json('tech_stack_ids')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('featured_works');
    }
};

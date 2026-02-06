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
        Schema::create('my_experiences', function (Blueprint $table) {
            $table->id();
            $table->string('job_title', 50);
            $table->string('recruiter_name', 50);
            $table->year('from_year');
            $table->year('to_year')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('my_experiences');
    }
};

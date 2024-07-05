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
        Schema::create('resumes', function (Blueprint $table) {
            $table->id();
            $table->string('fullname'); // varchar
            $table->string('email'); // varchar
            $table->string('phone', 24)->nullable(); // varchar, nullable
            $table->text('summary')->nullable(); // text, nullable
            $table->string('image', 512)->nullable(); // varchar, nullable
            $table->char('language', 3); // varchar(3)
            $table->text('json_resume'); // text
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resumes');
    }
};

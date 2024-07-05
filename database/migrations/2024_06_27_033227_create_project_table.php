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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('resume_id')->constrained()->onDelete('cascade'); // foreign key, bigint(20)
            $table->string('name', 80); // varchar
            $table->integer('year'); // integer
            $table->string('summary', 128)->nullable(); // varchar, nullable
            $table->text('description')->nullable(); // text, nullable
            $table->string('keywords', 256)->nullable(); // varchar, nullable
            $table->string('url', 300)->nullable(); // varchar, nullable
            $table->boolean('in_production')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};

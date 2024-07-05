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
        Schema::create('portfolio_sites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_user_id')->constrained()->onDelete('cascade'); // foreign key, bigint(20)
            $table->foreignId('resume_id')->constrained()->onDelete('cascade'); // foreign key, bigint(20)
            $table->string('name', 48); // varchar
            $table->string('base_url', 48); // varchar
            $table->string('meta_description', 160); // varchar(160)
            $table->string('meta_title', 60); // varchar(60)
            $table->string('meta_author', 60); // varchar(60)
            $table->string('meta_keywords', 90); // varchar(90)
            $table->boolean('active')->default(true); // boolean, default true
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portfolio_sites');
    }
};

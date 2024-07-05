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
        Schema::create('customer_users', function (Blueprint $table) {
            $table->id();
            $table->string('email', 64)->unique(); // unique, varchar
            $table->string('password', 256); // varchar
            $table->string('firstname', 48); // varchar
            $table->string('lastname', 48); // varchar
            $table->rememberToken(); // remember_token, varchar
            $table->boolean('active')->default(true); // boolean, default true
            $table->boolean('payed')->default(false); // boolean, default false
            $table->boolean('banned')->default(false); // boolean, default false
            $table->timestamps(); // created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_users');
    }
};

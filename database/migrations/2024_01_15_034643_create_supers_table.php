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
        Schema::create('supers', function (Blueprint $table) {
            $table->id();
            $table->string('fullname');
            $table->string('username')->nullable();
            $table->string('photo')->nullable();
            $table->string('phone')->nullable();
            $table->string('designation')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->text('address')->nullable();
            $table->integer('policestationId')->nullable();
            $table->integer('districtId')->nullable();
            $table->integer('divisionId')->nullable();
            $table->integer('cityId')->nullable();
            $table->integer('countryId')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('dateOfBirth')->nullable();
            $table->string('gender')->nullable();
            $table->text('description')->nullable();
            $table->string('type');
            $table->string('theme')->default('default')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supers');
    }
};

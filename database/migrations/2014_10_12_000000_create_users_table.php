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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('username')->nullable();
            $table->string('title')->nullable();
            $table->string('smalltitle')->nullable();
            $table->string('license')->nullable();
            $table->string('licenseExpiry')->nullable();
            $table->string('description')->nullable();
            $table->string('proprietor')->nullable();
            $table->string('proprietortitle')->nullable();
            $table->string('logo')->nullable();
            $table->text('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('title_bn')->nullable();
            $table->string('license_bn')->nullable();
            $table->text('description_bn')->nullable();
            $table->string('proprietor_bn')->nullable();
            $table->string('proprietortitle_bn')->nullable();
            $table->text('address_bn')->nullable();
            $table->string('telephone_bn')->nullable();
            $table->string('title_ar')->nullable();
            $table->string('license_ar')->nullable();
            $table->text('description_ar')->nullable();
            $table->text('address_ar')->nullable();
            $table->string('proprietor_ar')->nullable();
            $table->string('proprietortitle_ar')->nullable();
            $table->string('telephone_ar')->nullable();
            $table->string('photo')->nullable();
            $table->string('designation')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->integer('policestationId')->nullable();
            $table->integer('districtId')->nullable();
            $table->integer('divisionId')->nullable();
            $table->integer('cityId')->nullable();
            $table->integer('countryId')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('dateOfBirth')->nullable();
            $table->string('gender')->nullable();
            $table->enum('role',['admin','author','editor','contributor','user'])->default('user');
            $table->string('trans_date')->nullable();
            $table->string('userExpiry')->nullable();
            $table->string('payment_data')->nullable();
            $table->string('trans_system')->nullable();
            $table->string('trans_amount')->nullable();
            $table->enum('type',['approve','pending','disable'])->default('approve');
            $table->enum('status',['active','inactive'])->default('active');
            $table->string('theme')->default('default')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

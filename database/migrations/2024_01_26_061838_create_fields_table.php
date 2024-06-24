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
        Schema::create('fields', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('smalltitle')->nullable();
            $table->string('license');
            $table->string('licenseExpiry')->nullable();
            $table->text('description')->nullable();
            $table->text('address')->nullable();
            $table->string('proprietor');
            $table->string('proprietortitle')->nullable();
            $table->string('logo')->nullable();
            $table->string('telephone')->nullable();
            $table->string('cellphone')->nullable();
            $table->string('helpline')->nullable();
            $table->string('web')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fields');
    }
};

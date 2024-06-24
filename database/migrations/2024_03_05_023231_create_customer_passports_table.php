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
        Schema::create('customer_passports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customerId');
            $table->foreign('customerId')->references('id')->on('customers')->onDelete('cascade');
            $table->string('father')->nullable();
            $table->string('mother')->nullable();
            $table->string('spouse')->nullable();
            $table->string('passportIssue')->nullable();
            $table->string('passportExpiry')->nullable();
            $table->string('passportType')->nullable();
            $table->string('nid')->nullable();
            $table->string('dateOfBirth')->nullable();
            $table->integer('maritalStatus')->nullable();
            $table->text('address')->nullable();
            $table->integer('issuePlaceId')->nullable();
            $table->integer('policestationId')->nullable();
            $table->integer('districtId')->nullable();
            $table->integer('divisionId')->nullable();
            $table->integer('countryId')->nullable();
            $table->integer('userId')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_passports');
    }
};

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
        Schema::create('customer_visas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customerId');
            $table->foreign('customerId')->references('id')->on('customers')->onDelete('cascade');
            $table->string('stamped_visano')->nullable();
            $table->string('visa_issue')->nullable();
            $table->string('visa_expiry')->nullable();
            $table->string('stay_duration')->nullable();
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
        Schema::dropIfExists('customer_visas');
    }
};

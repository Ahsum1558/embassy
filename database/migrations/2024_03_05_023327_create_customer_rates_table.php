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
        Schema::create('customer_rates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customerId');
            $table->foreign('customerId')->references('id')->on('customers')->onDelete('cascade');
            $table->string('workingRate')->nullable();
            $table->string('extraCharge')->nullable();
            $table->string('rateDescription')->nullable();
            $table->string('discount')->nullable();
            $table->string('moneyBack')->nullable();
            $table->integer('value')->nullable();
            $table->integer('userId')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_rates');
    }
};

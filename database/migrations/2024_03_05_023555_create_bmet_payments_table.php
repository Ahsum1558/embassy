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
        Schema::create('bmet_payments', function (Blueprint $table) {
            $table->id();
            $table->integer('manpowerSubId')->nullable();
            $table->string('customerNumber')->nullable();
            $table->string('taxPayBank')->nullable();
            $table->string('incomeTax')->nullable();
            $table->string('incomeTaxNo')->nullable();
            $table->string('incomeTaxDate')->nullable();
            $table->string('insurancePayBank')->nullable();
            $table->string('welfareInsurance')->nullable();
            $table->string('welfareInsuranceNo')->nullable();
            $table->string('welfareInsuranceDate')->nullable();
            $table->string('smartPayBank')->nullable();
            $table->string('smartCard')->nullable();
            $table->string('smartCardNo')->nullable();
            $table->string('smartCardDate')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->integer('userId')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bmet_payments');
    }
};

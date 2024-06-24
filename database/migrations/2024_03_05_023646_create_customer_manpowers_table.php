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
        Schema::create('customer_manpowers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('customerId')->unsigned();
            $table->integer('manpowerSubId')->nullable();
            $table->string('customerPhone')->nullable();
            $table->string('fatherPhone')->nullable();
            $table->string('motherPhone')->nullable();
            $table->string('certificateNo')->nullable();
            $table->string('batchNo')->nullable();
            $table->string('rollNo')->nullable();
            $table->string('ttcname')->nullable();
            $table->string('accountNo')->nullable();
            $table->string('bankname')->nullable();
            $table->string('bankbranch')->nullable();
            $table->string('medicalCenter')->nullable();
            $table->string('immigrationCosts')->nullable();
            $table->string('finger_regno')->nullable();
            $table->string('salary')->nullable();
            $table->string('ordinal')->nullable();
            $table->tinyInteger('value')->default(0);
            $table->integer('userId')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_manpowers');
    }
};

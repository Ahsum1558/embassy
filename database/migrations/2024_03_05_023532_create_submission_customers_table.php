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
        Schema::create('submission_customers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customerId');
            $table->foreign('customerId')->references('id')->on('customers')->onDelete('cascade');
            $table->integer('submissionId')->nullable();
            $table->string('submissionType')->nullable();
            $table->string('ordinal')->nullable();
            $table->string('visaYear')->nullable();
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
        Schema::dropIfExists('submission_customers');
    }
};

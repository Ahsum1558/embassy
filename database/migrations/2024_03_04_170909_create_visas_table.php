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
        Schema::create('visas', function (Blueprint $table) {
            $table->id();
            $table->string('visano_en')->nullable();
            $table->string('visano_ar')->nullable();
            $table->string('visano_img')->nullable();
            $table->string('sponsorid_en')->nullable();
            $table->string('sponsorid_ar')->nullable();
            $table->string('sponsorname_en')->nullable();
            $table->string('sponsorname_ar')->nullable();
            $table->string('visa_date')->nullable();
            $table->string('visa_address')->nullable();
            $table->string('occupation_en')->nullable();
            $table->string('occupation_ar')->nullable();
            $table->string('delegation_no')->nullable();
            $table->string('delegation_date')->nullable();
            $table->string('delegated_visa')->nullable();
            $table->string('visa_duration')->nullable();
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
        Schema::dropIfExists('visas');
    }
};

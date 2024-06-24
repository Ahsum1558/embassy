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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('customersl')->nullable();
            $table->string('bookRef')->nullable();
            $table->string('cusFname')->nullable();
            $table->string('cusLname')->nullable();
            $table->string('gender')->nullable();
            $table->string('passportNo')->nullable();
            $table->string('passport_img')->nullable();
            $table->string('phone')->nullable();
            $table->integer('agentId')->nullable();
            $table->string('photo')->nullable();
            $table->string('passportCopy')->nullable();
            $table->integer('birthPlace')->nullable();
            $table->string('medical')->nullable();
            $table->string('medical_update')->nullable();
            $table->string('received')->nullable();
            $table->integer('tradeId')->nullable();
            $table->integer('countryFor')->nullable();
            $table->tinyInteger('emblist')->default(0);
            $table->tinyInteger('manpowerlist')->default(0);
            $table->string('delivered')->nullable();
            $table->string('flight')->nullable();
            $table->tinyInteger('value')->default(0);
            $table->tinyInteger('rateValue')->default(0);
            $table->tinyInteger('umrahValue')->default(0);
            $table->tinyInteger('hajjValue')->default(0);
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
        Schema::dropIfExists('customers');
    }
};

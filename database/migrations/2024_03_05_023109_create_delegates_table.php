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
        Schema::create('delegates', function (Blueprint $table) {
            $table->id();
            $table->string('agentsl')->nullable();
            $table->string('agentbook')->nullable();
            $table->string('agentname')->nullable();
            $table->string('father')->nullable();
            $table->string('nid')->nullable();
            $table->string('office')->nullable();
            $table->string('officeLocation')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('dateOfBirth')->nullable();
            $table->string('gender')->nullable();
            $table->text('address')->nullable();
            $table->string('accountNo')->nullable();
            $table->string('bankname')->nullable();
            $table->string('bankbranch')->nullable();
            $table->string('photo')->nullable();
            $table->integer('policestationId')->nullable();
            $table->integer('districtId')->nullable();
            $table->integer('divisionId')->nullable();
            $table->integer('cityId')->nullable();
            $table->integer('countryId')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('description')->nullable();
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
        Schema::dropIfExists('delegates');
    }
};

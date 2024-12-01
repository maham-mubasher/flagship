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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('country_id');
            $table->foreign('country_id')->references('id')->on('countries');
            $table->foreignId('province_id')->nullable();
            $table->foreign('province_id')->references('id')->on('provinces');
            $table->foreignId('address_group_id');
            $table->foreign('address_group_id')->references('id')->on('address_groups');
            $table->string('address');
            $table->string('email')->nullable();
            $table->string('other_state')->nullable();
            $table->string('company_name');
            $table->string('attention');
            $table->string('suite')->nullable();
            $table->string('department')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->boolean('is_residential_address')->default(0);
            $table->string('phone');
            $table->string('ext')->nullable();
            $table->string('tax_id')->nullable();
            $table->string('shipping_account')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};

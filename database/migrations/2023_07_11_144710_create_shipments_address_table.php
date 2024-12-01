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
        Schema::create('shipments_address', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shipment_id');
            $table->foreign('shipment_id')->references('id')->on('shipments');
            $table->foreignId('country_id');
            $table->foreign('country_id')->references('id')->on('countries');
            $table->foreignId('province_id')->nullable();
            $table->foreign('province_id')->references('id')->on('provinces');
            $table->timestamps();
            $table->string('address');
            $table->string('address_type');
            $table->string('tracking_email')->nullable();
            $table->string('company_name')->nullable();
            $table->string('attention')->nullable();
            $table->string('suite')->nullable();
            $table->string('department')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('city')->nullable();
            $table->boolean('is_residential_address')->default(0);
            $table->string('phone')->nullable();
            $table->string('ext')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipments_address');
    }
};

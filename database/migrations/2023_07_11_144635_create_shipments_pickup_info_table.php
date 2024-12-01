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
        Schema::create('shipments_pickup_info', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shipment_id');
            $table->foreign('shipment_id')->references('id')->on('shipments');
            $table->time('time_from');
            $table->time('time_until');
            $table->string('pickup_location');
            $table->text('pickup_instruction')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipments_pickup_info');
    }
};

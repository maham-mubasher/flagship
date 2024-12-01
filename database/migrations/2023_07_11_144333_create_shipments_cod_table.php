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
        Schema::create('shipments_cod', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shipment_id');
            $table->foreign('shipment_id')->references('id')->on('shipments');
            $table->string('payment_method')->nullable();
            $table->string('payable_to')->nullable();
            $table->string('reciever_phone')->nullable();
            $table->string('amount')->nullable();
            $table->string('currency')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipments_cod');
    }
};

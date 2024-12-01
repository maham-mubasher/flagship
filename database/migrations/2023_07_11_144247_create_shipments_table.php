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
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->on('users')->references('id')->onDelete('cascade');
            $table->date('shipment_date');
            $table->string('reference')->nullable();
            $table->string('driver_instructions')->nullable();
            $table->string('signature_required')->nullable();
            $table->boolean('saturday_delivery')->default(0);
            $table->string('payment_payer');
            $table->string('payment_account_number')->nullable();
            $table->boolean('is_schedule_pickup')->default(0);
            $table->boolean('is_cod')->default(0);
            $table->boolean('is_insurance')->default(0);
           


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipments');
    }
};

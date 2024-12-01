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
        Schema::create('order_supplies', function (Blueprint $table) {
            $table->id();
            $table->mediumText('ups')->nullable();
            $table->mediumText('dhl')->nullable();
            $table->mediumText('fedex')->nullable();
            $table->mediumText('purolator')->nullable();
            $table->mediumText('gls')->nullable();
            $table->mediumText('nationex')->nullable();
            $table->mediumText('to');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_supplies');
    }
};

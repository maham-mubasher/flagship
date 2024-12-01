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
        Schema::create('pickups', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->on('users')->references('id')->onDelete('cascade');$table->foreignId('to_country_id');
            $table->foreign('to_country_id')->references('id')->on('countries');
            $table->foreignId('country_id');
            $table->foreign('country_id')->references('id')->on('countries');
            $table->foreignId('province_id')->nullable();
            $table->foreign('province_id')->references('id')->on('provinces');
            $table->string('company_name');
            $table->string('sender_name');
            $table->string('address');
            $table->string('suite')->nullable();
            $table->string('postal_code');
            $table->string('city');
            $table->string('phone');
            $table->string('ext')->nullable();
            $table->string('courier_name');
            $table->unsignedBigInteger('package_count')->default(0);
            $table->string('unit');
            $table->decimal('weight', 8, 2)->default(0);
            
            $table->date('pickup_date');
            $table->time('time_from');
            $table->time('time_until');
            $table->string('pickup_location');
            $table->text('pickup_instruction');
            $table->boolean('is_ground')->default('0');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pickups');
    }
};

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
        Schema::create('screenings', function (Blueprint $table) {
            $table->id();
            $table->dateTime('timestamp_screening');
            $table->bigInteger('mb_screening_id');
            $table->bigInteger('screening_id');
            $table->string('client_id')->nullable();
            $table->string('xyzh')->nullable();
            $table->string('client_x_or_y_or_z')->nullable();
            $table->string('purchase_status')->nullable();
            $table->string('employment_status')->nullable();
            $table->string('client_name');
            $table->string('nationality');
            $table->date('date_of_birth');
            $table->text('current_priority');
            $table->text('remarks')->nullable();
            $table->string('ic');
            $table->string('email');
            $table->string('mobile_number');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('screenings');
    }
};

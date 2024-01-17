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
        Schema::create('screening_latest_results', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Screening::class)->constrained();
            $table->string('primary_client_x_or_partner_y_available')->default(0)->nullable();
            $table->string('xs_or_ys_le')->nullable();
            $table->string('xs_ys_ltv')->nullable();
            $table->string('partner_z_available')->default(0)->nullable();
            $table->string('zs_le')->nullable();
            $table->string('zs_ltv')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('screening_latest_results');
    }
};

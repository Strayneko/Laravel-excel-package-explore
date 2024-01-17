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
        Schema::create('house_loan_summaries', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Screening::class)->constrained();
            $table->bigInteger('summary_house_loan_id')->default(0)->nullable();
            $table->string('type')->nullable();
            $table->string('monthly_income')->default(0)->nullable();
            $table->string('monthly_installment')->default(0)->nullable();
            $table->string('dsr_percentage')->default(0)->nullable();
            $table->string('dsr_rating')->default(0)->nullable();
            $table->string('ltv_percentage')->default(0)->nullable();
            $table->string('max_tenure_years')->default(0)->nullable();
            $table->string('interest_percentage')->default(0)->nullable();
            $table->string('max_dsr_percentage')->default(0)->nullable();
            $table->string('loan_eligibility')->default(0)->nullable();
            $table->string('le_rating')->default(0)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('house_loan_summaries');
    }
};

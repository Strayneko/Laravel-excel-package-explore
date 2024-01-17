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
        Schema::create('summaries', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Screening::class)->constrained();
            $table->bigInteger('summary_id')->nullable();
            $table->string('monthly_active_income')->nullable()->default(0);
            $table->string('monthly_passive_income')->nullable()->default(0);
            $table->string('total_deduction')->nullable()->default(0);
            $table->string('monthly_hustle_income')->nullable()->default(0);
            $table->string('monthly_commitment')->nullable()->default(0);
            $table->string('liquid_cash_position')->nullable()->default(0);
            $table->string('immediate_cash_position')->nullable()->default(0);
            $table->string('medium_term_cash_position')->nullable()->default(0);
            $table->integer('total_properties')->nullable()->default(0);
            $table->integer('total_refinance_equity')->nullable()->default(0);
            $table->string('total_monthly_property_installment')->nullable()->default(0);
            $table->string('total_monthly_rent')->nullable()->default(0);
            $table->string('epf_account_2')->nullable();
            $table->string('total_unsecured_loan')->nullable()->default(0);
            $table->string('monthly_unsecured_loan')->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('summaries');
    }
};

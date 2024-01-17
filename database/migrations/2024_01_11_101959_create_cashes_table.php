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
        Schema::create('cashes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Screening::class)->constrained();
            $table->bigInteger('cash_id')->nullable();
            $table->string('bank_account_total')->default(0)->nullable();
            $table->string('epf_account_1')->nullable();
            $table->string('epf_account_2')->nullable();
            $table->string('excess_epf')->nullable();
            $table->string('asb_cash')->nullable();
            $table->string('tabung_haji')->nullable();
            $table->string('mutual_funds_or_ut')->nullable();
            $table->string('stocks_and_bonds')->nullable();
            $table->string('insurance_savings')->nullable();
            $table->string('other_cash_total')->nullable();
            $table->string('monthly_cash_savings')->nullable();
            $table->string('short_term_friendly_loan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cashes');
    }
};

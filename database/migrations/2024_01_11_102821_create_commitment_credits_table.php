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
        Schema::create('commitment_credits', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Screening::class)->constrained();
            $table->bigInteger('commitment_credit_id')->nullable();
            $table->string('bankruptcy')->default(0)->nullable();
            $table->string('legal_record')->default(0)->nullable();
            $table->string('special_attention_account')->default(0)->nullable();
            $table->string('dishonoured_cheque')->default(0)->nullable();
            $table->string('trade_referee_listing')->default(0)->nullable();
            $table->string('installment_in_arrear')->default(0)->nullable();
            $table->string('ccris_less_3_months')->default(0)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commitment_credits');
    }
};

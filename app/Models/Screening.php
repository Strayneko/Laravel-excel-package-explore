<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Screening extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function summary(): HasOne
    {
        return $this->hasOne(Summary::class);
    }

    public function houseLoanSummaries(): HasOne
    {
        return $this->hasOne(HouseLoanSummary::class);
    }

    public function cash(): HasOne
    {
        return $this->hasOne(Cash::class);
    }

    public function commitmentCredit(): HasOne
    {
        return $this->hasOne(CommitmentCredit::class);
    }

    public function creditAssessments(): HasMany
    {
        return $this->hasMany(CreditAssessment::class);
    }

    public function screeningLatestResult(): HasOne
    {
        return $this->hasOne(ScreeningLatestResult::class);
    }
}

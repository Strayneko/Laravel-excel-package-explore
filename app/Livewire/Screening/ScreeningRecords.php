<?php

namespace App\Livewire\Screening;

use App\Models\Screening;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Livewire\Component;

class ScreeningRecords extends Component
{
    public $screeningDetail;

    public array $screeningColumns;
    public array $summaryColumns;
    public array $houseLoanSummaryColumns;
    public array $cashColumns;
    public array $commitmentCreditColumns;
    public array $screeningLatestResultColumns;
    public array $creditAssessmentColumns;

    public $houseLoanAggressive;
    public $houseLoanConservative;


    public function mount()
    {
        $this->screeningColumns = $this->getColumns('screenings');
        $this->summaryColumns = $this->getColumns('summaries');
        $this->houseLoanSummaryColumns = $this->getColumns('house_loan_summaries');
        $this->cashColumns = $this->getColumns('cashes');
        $this->commitmentCreditColumns = $this->getColumns('commitment_credits');
        $this->screeningLatestResultColumns = $this->getColumns('screening_latest_results');
        $this->creditAssessmentColumns = $this->getColumns('credit_assessments');
    }

    public function showDetailModal(int $screeningId)
    {
        $this->dispatch('show-detail-modal');
        $this->screeningDetail = Screening::query()
                                          ->with(['summary', 'houseLoanSummaries', 'cash', 'commitmentCredit', 'screeningLatestResult', 'creditAssessments'])
                                          ->where('id', $screeningId)
                                          ->first();

        $this->houseLoanAggressive   = $this->screeningDetail->houseLoanSummaries->where('type', 'Aggressive')->first() ?? [];
        $this->houseLoanConservative = $this->screeningDetail->houseLoanSummaries->where('type', 'Conservative')->first() ?? [];
    }

    public function formatColumnName(?string $column): string
    {
        if(is_null($column)) return 'N/A';

        return Str::of($column)
                   ->replace('_or_', '/')
                   ->replace('_', ' ')
                   ->title();
    }

    private function getColumns(string $table): array
    {
        return array_diff(Schema::getColumnListing($table), ['id', 'updated_at', 'created_at', 'screening_id']);
    }

    public function render()
    {
        $screenings = Screening::query()->paginate(10);
        return view('livewire.screening.screening-records', compact('screenings'));
    }
}

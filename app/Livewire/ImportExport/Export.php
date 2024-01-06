<?php

namespace App\Livewire\ImportExport;

use App\Exports\SalaryExport;
use App\Livewire\Forms\ImportExport\ExportForm;
use App\Models\Salary;
use Illuminate\Support\Facades\Schema;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class Export extends Component
{
    public array $columns = [];

    public ExportForm $form;

    public int $exportProgress = 0;

    public int $currentRow = 1;

    public int $totalRow = 1;

    public function mount()
    {
        $this->columns = Schema::getColumnListing('salaries');
        $this->form->selectedColumn = $this->columns;
        $this->totalRow = Salary::query()->count();
    }

    public function export()
    {
        $this->form->validate();
        return Excel::download(new SalaryExport($this->form->selectedColumn, function ($row) {
            $this->stream(to: 'currentRow', content: $row, replace: true);
            $this->stream(to: 'exportProgress', content: ($row/$this->totalRow) * 100, replace: true);
        }), 'tes.' . $this->form->exportType, ucfirst($this->form->exportType));
    }

    public function render()
    {
        return view('livewire.import-export.export');
    }
}

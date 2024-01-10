<?php

namespace App\Livewire\ImportExport;

use App\Exports\SalaryExport;
use App\Livewire\Forms\ImportExport\ExportForm;
use App\Models\Salary;
use Illuminate\Support\Facades\Schema;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class Export extends Component
{
    public array $columns = [];

    public ExportForm $form;

    public int $currentRow = 1;

    public int $totalRow = 1;

    public function mount(): void
    {
        $this->columns              = Schema::getColumnListing('salaries');
        $this->form->selectedColumn = $this->columns;

        $rowCount                   = Salary::query()->count();
        $this->totalRow             = $rowCount === 0 ? 1 : $rowCount;
    }

    public function export(): BinaryFileResponse
    {
        $this->form->validate();

        $now      = now()->format('d-F-Y_H-i-s');
        $fileName = "{$now}_exported_document.{$this->form->exportType}";
        return Excel::download(new SalaryExport($this->form->selectedColumn, function ($row) {
            $this->stream(to: 'currentRow', content: $row, replace: true);
        }), $fileName, ucfirst($this->form->exportType));
    }

    public function render()
    {
        return view('livewire.import-export.export');
    }
}

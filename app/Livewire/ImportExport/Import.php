<?php

namespace App\Livewire\ImportExport;

use App\Imports\ImportExport\ImportSalary;
use App\Livewire\Forms\ImportExport\ImportForm;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class Import extends Component
{
    use WithFileUploads;

    public ImportForm $form;

    public int $currentRow = 1;

    public int $totalRows = 1;


    public function import(): void
    {
        $this->form->validate();

        Excel::import(new ImportSalary(function (int $row, int $total){
            $this->stream(to: 'currentRow', replace: true, content: $row);
            $this->stream(to: 'totalRows', replace: true, content: $total === 0 ? 1 : $total);
        }), $this->form->file->getRealPath());

        $this->dispatch('import-finished');
        $this->dispatch('refresh-table');
    }


    public function render()
    {
        return view('livewire.import-export.import');
    }
}

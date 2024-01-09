<?php

namespace App\Livewire\ImportExport;

use App\Models\Salary;
use Livewire\Component;

class Index extends Component
{

    public function flushTable(): void
    {
        Salary::query()->delete();
        $this->dispatch('refresh-table');
    }

    public function render()
    {
        return view('livewire.import-export.index');
    }
}

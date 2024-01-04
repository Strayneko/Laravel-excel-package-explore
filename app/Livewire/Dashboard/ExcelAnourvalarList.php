<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;

class ExcelAnourvalarList extends Component
{
    public string $samplePage = '1';

    public function goToSample(string $page): void
    {
        $this->samplePage = $page;
    }

    public function render()
    {
        return view('livewire.dashboard.excel-anourvalar-list');
    }
}

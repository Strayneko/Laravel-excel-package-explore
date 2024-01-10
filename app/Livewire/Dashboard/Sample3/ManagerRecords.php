<?php

namespace App\Livewire\Dashboard\Sample3;

use App\Models\Manager;
use Livewire\Component;

class ManagerRecords extends Component
{
    public array $managers;

    public function mount(array $managers): void
    {
        $this->managers = $managers;
    }

    public function render()
    {
        return view('livewire.dashboard.sample3.manager-records');
    }
}

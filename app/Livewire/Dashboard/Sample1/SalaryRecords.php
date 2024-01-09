<?php

namespace App\Livewire\Dashboard\Sample1;

use App\Models\Salary;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class SalaryRecords extends Component
{
    use WithPagination;

    #[On('refresh-table')]
    public function refreshTable()
    {
        $this->dispatch('$refresh');
    }

    public function render()
    {
        $salaries = Salary::query()->select('id', 'name', 'base_salary', 'bonus')->paginate(perPage: 10, pageName: 'salary-page');
        return view('livewire.dashboard.sample1.salary-records', compact('salaries'));
    }
}

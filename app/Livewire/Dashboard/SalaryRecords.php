<?php

namespace App\Livewire\Dashboard;

use App\Models\Salary;
use Livewire\Component;
use Livewire\WithPagination;

class SalaryRecords extends Component
{
    use WithPagination;
    public function render()
    {
        $salaries = Salary::query()->select('id', 'name', 'base_salary', 'bonus')->paginate(10);
        return view('livewire.dashboard.salary-records', compact('salaries'));
    }
}

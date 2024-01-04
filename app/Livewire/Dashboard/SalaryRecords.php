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
        $salaries = Salary::query()->select('id', 'name', 'base_salary', 'bonus')->paginate(perPage: 10, pageName: 'salary-page');
        return view('livewire.dashboard.salary-records', compact('salaries'));
    }
}

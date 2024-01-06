<?php

namespace App\Exports;

use App\Models\Salary;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SalaryExport implements FromQuery, WithHeadings, WithMapping
{
    public array $selectedColumn;

    private $callback;

    private int $currentRow = 1;

   public function __construct(array $selectedColumn = [], $callback)
   {
       $this->selectedColumn = $selectedColumn;
       $this->callback = $callback;
   }

   /** {@inheritDoc} */
    public function query(): Builder
   {
       $query = empty($this->selectedColumn) ? Salary::query() : Salary::query()->select($this->selectedColumn);
       return $query;
   }

    /** {@inheritDoc} */
   public function headings(): array
   {
       if(empty($this->selectedColumn))
       {
           return [
               'Id',
               'Name',
               'Base Salary',
               'Bonus',
               'Created At',
               'Updated At',
           ];
       }

       return array_map(function ($column){
           return Str::of($column)->replace('_', ' ')->title();
       }, $this->selectedColumn);
   }

   /** {@inheritDoc} */
   public function map($salary): array
   {
       ($this->callback)($this->currentRow);
        $data = [
            'id'          => $salary->id,
            'name'        => $salary->name,
            'base_salary' => $salary->base_salary,
            'bonus'       => $salary->bonus,
            'created_at'  => $salary->created_at->format('d F Y H:i:s'),
            'updated_at'  => $salary->updated_at->format('d F Y H:i:s'),
        ];

       $this->currentRow++;

        return Arr::only($data, $this->selectedColumn);
   }
}

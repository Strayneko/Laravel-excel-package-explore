<?php

namespace App\Imports\ImportExport;

use App\Models\Salary;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\RemembersRowNumber;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeImport;

class ImportSalary implements ToCollection, WithBatchInserts, WithEvents
{
    use RemembersRowNumber;

    private $callback;

    private int $totalRows;

    public function __construct( $callback)
    {
        $this->callback = $callback;
    }

    /** {@inheritDoc} */
    public function collection(Collection $rows)
    {
        foreach($rows as $index => $row)
        {
            if($index === 0 ) continue;

            ($this->callback)($index, $this->totalRows - 1);

            Salary::updateOrCreate([
                'name'        => $row[1] ?? '-',
                'base_salary' => $row[2] ?? 0,
                'bonus'       => $row[3] ?? 0,
        ], [
            'name' => $row[1] ?? null,
            ]);
        }
    }


    /** {@inheritDoc} */
    public function batchSize(): int
    {
        return 1000;
    }

    public function registerEvents(): array
    {
        return [
            BeforeImport::class => function (BeforeImport $event) {
                $this->totalRows = $event->getReader()->getTotalRows()['Worksheet'] ?? 1;
            }
        ];
    }
}

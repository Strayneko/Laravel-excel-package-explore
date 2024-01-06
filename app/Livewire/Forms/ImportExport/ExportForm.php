<?php

namespace App\Livewire\Forms\ImportExport;

use Livewire\Attributes\Validate;
use Livewire\Form;

class ExportForm extends Form
{
    #[Validate(['required', 'array'])]
    public array $selectedColumn = [];

    #[Validate(['required', 'in:csv,xlsx'])]
    public string $exportType = 'csv';
}

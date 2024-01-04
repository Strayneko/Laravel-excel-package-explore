<?php

namespace App\Livewire\Forms\Dashboard;

use Livewire\Attributes\Validate;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Form;

class ExcelTestForm extends Form
{
    #[Validate(['required', 'file', 'mimes:csv,xlsx'])]
    public ?TemporaryUploadedFile $file;

    public function getTemplatePath(): string
    {
        if(is_null($this->file)) return '';

        return $this->file->getRealPath();
    }
}

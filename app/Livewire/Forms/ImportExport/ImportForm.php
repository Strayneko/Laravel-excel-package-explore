<?php

namespace App\Livewire\Forms\ImportExport;

use Livewire\Attributes\Validate;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Form;

class ImportForm extends Form
{
    #[Validate(['required', 'file', 'mimes:csv,xlsx'])]
    public TemporaryUploadedFile $file;
}

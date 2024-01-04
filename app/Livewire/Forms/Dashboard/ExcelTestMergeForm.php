<?php

namespace App\Livewire\Forms\Dashboard;

use Livewire\Attributes\Validate;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Form;

class ExcelTestMergeForm extends Form
{
    #[Validate(['required', 'file', 'mimes:csv,xlsx'])]
    public TemporaryUploadedFile $file;

    #[Validate(['required', 'file', 'mimes:csv,xlsx'])]
    public TemporaryUploadedFile $file2;
}

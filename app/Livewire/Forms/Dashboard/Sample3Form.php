<?php

namespace App\Livewire\Forms\Dashboard;

use Livewire\Attributes\Validate;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Form;

class Sample3Form extends Form
{
    #[Validate(['required', 'file', 'mimes:csv,xlsx'])]
    public ?TemporaryUploadedFile $file;
}

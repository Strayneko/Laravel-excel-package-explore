<?php

namespace App\Livewire\Dashboard;

use App\Livewire\Forms\Dashboard\Sample3Form;
use App\Models\Manager;
use App\Service\PipelineService;
use Livewire\Component;
use Livewire\WithFileUploads;
use Symfony\Component\HttpFoundation\StreamedResponse;

class Sample3 extends Component
{
    use WithFileUploads;
    
    public Sample3Form $form;

    public array $managers = [];

    private PipelineService $pipelineService;

    public function boot()
    {
        $this->pipelineService = new PipelineService();
    }

    public function mount(): void
    {
        $this->managers = [
            'best_manager' => 'Sveta',

            'managers' => [
                'titles' => [[ 'William', 'James', 'Sveta' ]],

                'values' => [
                    [
                        'month' => 'January',
                        'amount' => [700, 800, 900],
                    ],
                    [
                        'month' => 'February',
                        'amount' => [7000, 8000, 9000],
                    ],
                    [
                        'month' => 'March',
                        'amount' => [70000, 80000, 90000],
                    ],
                ],
            ],
        ];
    }

    public function submit(): StreamedResponse
    {
        $this->form->validate();
        $pipeline = $this->pipelineService
                         ->setTemplateFile($this->form->file->getRealPath())
                         ->setData($this->managers)
                         ->setFilePath('generated_documents')
                         ->saveFile();

        return $pipeline->download();
    }

    public function render()
    {
        return view('livewire.dashboard.sample3');
    }
}

<?php

namespace App\Livewire\Dashboard;

use App\Livewire\Forms\Dashboard\ExcelTestForm;
use App\Models\Salary;
use App\Service\PipelineService;
use Livewire\Component;
use Livewire\WithFileUploads;
use Symfony\Component\HttpFoundation\StreamedResponse;

class Sample1 extends Component
{
    use WithFileUploads;

    public ExcelTestForm $form;

    private PipelineService $pipelineService;

    /** {@inheritDoc} */
    public function boot(): void
    {
        $this->pipelineService = new PipelineService();
    }

    /**
     * Handle submit to generate data based from the uploaded template
     * @return StreamedResponse
     */
    public function submit(): StreamedResponse
    {
        $this->form->validate();

        $pipeline = $this->pipelineService->setTemplateFile($this->form->getTemplatePath())
                         ->setData($this->getData())
                         ->setFilePath('generated_documents.xlsx', 'documents')
                         ->saveFile();

        return $pipeline->download();
    }

    /**
     * Get data for document
     * @return array
     */
    public function getData(): array
    {
        $salaries =  Salary::query()
                            ->select('name', 'base_salary', 'bonus')
                            ->chunkMap(function ($salary){
                                return [
                                    'name' => $salary->name,
                                    'base_salary' => number_format($salary->base_salary),
                                    'bonus' => number_format($salary->bonus),
                                ];
                            })
                            ->toArray();
        return compact('salaries');
    }

    public function render()
    {
        return view('livewire.dashboard.sample1');
    }
}

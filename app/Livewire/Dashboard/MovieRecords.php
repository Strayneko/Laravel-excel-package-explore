<?php

namespace App\Livewire\Dashboard;

use App\Livewire\Forms\Dashboard\ExcelTestMergeForm;
use App\Models\Movie;
use App\Service\PipelineService;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Symfony\Component\HttpFoundation\StreamedResponse;

class MovieRecords extends Component
{
    use WithPagination, WithFileUploads;

    public ExcelTestMergeForm $form;

    private PipelineService $pipelineService;

    public function boot(): void
    {
        $this->pipelineService = new PipelineService();
    }

    public function submit(): StreamedResponse
    {
        $this->form->validate();
        $data = $this->getData();
        $document1 = $this->pipelineService
                          ->setTemplateFile($this->form->file->getRealPath())
                          ->setData($data)
                          ->generate();

        $document2 = $this->pipelineService
                          ->setTemplateFile($this->form->file2->getRealPath())
                          ->setData($data)
                          ->generate();

        $mixer = $this->pipelineService
                      ->setFilePath('merged_documents.xlsx')
                      ->merge($document1, $document2);

        return $mixer->download();
    }

    /**
     * Format date to the specific format
     * @param string $date
     * @return string
     */
    public function formatDate(string $date): string
    {
        return Carbon::parse($date)->format('d F Y');
    }

    /**
     * Map and format data
     * @return array
     */
    private function getData(): array
    {
        $movies = Movie::query()
                        ->chunkMap(function ($movie){
                            return [
                                'title'           => $movie->title,
                                'description'     => $movie->description,
                                'image_url'       => $movie->image_url,
                                'producer'        => $movie->producer,
                                'production_cost' => number_format($movie->production_fee),
                                'revenue'         => number_format($movie->revenue),
                                'release_date'    => $this->formatDate($movie->release_date),
                            ];
                        })
                        ->toArray();

        return compact('movies');
    }

    public function render()
    {
        $movies = Movie::query()
                       ->select('title', 'producer', 'production_fee', 'revenue', 'release_date')
                       ->paginate(perPage: 10, pageName: 'movie-page');
        return view('livewire.dashboard.movie-records', compact('movies'));
    }
}

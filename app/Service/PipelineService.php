<?php

namespace App\Service;

use AnourValar\Office\Format;
use AnourValar\Office\Generated;
use AnourValar\Office\Mixer;
use AnourValar\Office\SheetsService;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class PipelineService{

    private SheetsService $sheetsService;

    private ?string $templateFileName = null;

    private array $data = [];

    private string $filePath;

    public function __construct()
    {
        $this->sheetsService = new SheetsService();
    }

    /**
     * Set template file
     * @param string|null $templateFile
     * @return $this
     */
    public function setTemplateFile(?string $templateFile): self
    {
        $this->templateFileName = $templateFile;

        return $this;
    }

    /**
     * Set data that will be placed into the document
     * @param array $data
     * @return $this
     */
    public function setData(array $data): self
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Set file path to store and download the document
     * @param string $fileName
     * @param string $path
     * @return $this
     */
    public function setFilePath(string $fileName, string $path = 'generated_documents'): self
    {
        $now            = now()->format('d-F-Y_H-i-s');
        $fileName       = "{$now}_{$fileName}";
        $this->filePath = "{$path}/{$fileName}";

        return $this;
    }

    /**
     * Store the document into storage
     * @return $this
     */
    public function saveFile(): self
    {

        $file =  $this->sheetsService
                      ->generate($this->templateFileName, $this->data)
                      ->save(Format::Xlsx);

        Storage::put($this->filePath, $file);
        return $this;
    }

    /**
     * Generate AnourValar\Office\Generated instance based on the given template and data
     * @return \AnourValar\Office\Generated
     */
    public function generate(): Generated
    {
        return $this->sheetsService
                    ->generate($this->templateFileName, $this->data);
    }


    /**
     * Merge generated documents into single document file
     * @param \AnourValar\Office\Generated ...$documents
     * @return $this
     */
    public function merge(...$documents): self
    {
        $mixer = new Mixer();
        $result = $mixer(...array_values($documents))->save(Format::Xlsx);

        Storage::put($this->filePath, $result);
        return $this;
    }

    /**
     * Download the document
     * @return StreamedResponse
     */
    public function download(): StreamedResponse
    {
        return Storage::download($this->filePath);
    }

}

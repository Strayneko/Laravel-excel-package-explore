<?php

namespace App\Service\Api;

use App\Exceptions\PropertyIsNotArrayException;
use App\Exceptions\PropertyNotFoundException;
use App\Models\Cash;
use App\Models\CommitmentCredit;
use App\Models\CreditAssessment;
use App\Models\HouseLoanSummary;
use App\Models\Screening;
use App\Models\ScreeningLatestResult;
use App\Models\Summary;
use Illuminate\Database\QueryException;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ScreeningService
{
    private array $screeningData = [];

    private array $summaryData = [];

    private array $houseLoanSummaryConsertiveData = [];

    private array $houseLoanSummaryAggressiveData = [];

    private array $cashData = [];

    private array $commitmentCreditData = [];

    private array $screeningLatestResultData = [];

    private array $creditAssessmentData = [];

    /**
     * @param array $data
     * @return self
     * @throws \App\Exceptions\PropertyNotFoundException
     */
    public function setScreeningData(array $data): self
    {
        $data['timestamp_screening'] = $this->formatDate($data['timestamp_screening'] ?? null, 'Y/m/d H:i:s');
        $data['date_of_birth'] = $this->formatDate($data['date_of_birth'] ?? null);

        return $this->setData($data, 'screeningData');
    }

    /**
     * @param array $data
     * @return self
     * @throws \App\Exceptions\PropertyNotFoundException
     */
    public function setSummaryData(array $data): self
    {
        return $this->setData($data, 'summaryData');
    }

    /**
     * Set house loan summary data
     * @param array $data
     * @param string $type Agressive/consertive
     * @return self
     * @throws \App\Exceptions\PropertyNotFoundException
     */
    public function setHouseLoanSummaryData(array $data, string $type): self
    {
        if(strtolower($type) === 'agressive') return $this->setData($data, 'houseLoanSummaryAggressiveData');

        return $this->setData($data, 'houseLoanSummaryConsertiveData');
    }

    /**
     * Set cash data
     * @param array $data
     * @return self
     * @throws \App\Exceptions\PropertyNotFoundException
     */
    public function setCashData(array $data): self
    {
        return $this->setData($data, 'cashData');
    }

    /**
     * set commintment credit data
     * @param array $data
     * @return self
     * @throws \App\Exceptions\PropertyNotFoundException
     */
    public function setCommitmentCreditData(array $data): self
    {
        return $this->setData($data, 'commitmentCreditData');
    }

    /**
     * Set screening latest result data
     * @param array $data
     * @return self
     * @throws \App\Exceptions\PropertyNotFoundException
     */
    public function setScreeningLatestResultData(array $data): self
    {
        return $this->setData($data, 'screeningLatestResultData');
    }

    /**
     * Set credit assessment data
     * @param array $data
     * @return self
     * @throws \App\Exceptions\PropertyNotFoundException
     */
    public function setCreditAssessmentData(array $data): self
    {
        $data = array_diff($data, ['credit_assessment_id']);
        $mappedData = [];

        foreach($data as $item)
        {
            array_push($mappedData, [
                'status' => $item,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return $this->setData($mappedData, 'creditAssessmentData');
    }

    /**
     * Store screening information into database
     * @return void
     */
    public function store(): void
    {
        DB::beginTransaction();
        try{
            $screening = Screening::query()->create($this->screeningData);

            $this->appendScreeningId($screening->id);
            $this->storeExtraScreeningData();

            DB::commit();
        }catch(\Exception $e){
            DB::rollBack();

            Log::error($e->getMessage());

            response()->json([
                'status'  => false,
                'code'    => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => "Failed to store the data. Please try again later.",
                'error'   => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR
            )->throwResponse();
        }

        response()->json([
            'status'  => true,
            'code'    => Response::HTTP_CREATED,
            'message' => 'Data has been stored successfully.',
        ], Response::HTTP_CREATED
        )->throwResponse();
    }

    /**
     * Set data to the given property name
     * @param array $data
     * @param string $propertyName
     * @param int|null $screeningId
     * @return self
     * @throws PropertyNotFoundException
     */
    private function setData(array $data, string $propertyName, ?int $screeningId = null): self
    {
        if(!property_exists($this, $propertyName)){
            throw new PropertyNotFoundException("Property {$propertyName} is not found.");
        }

        $this->$propertyName = $data;

        return $this;
    }

    /**
     * Add screening_id array key to the given property
     * @param int $screeningId
     * @param string $propertyName
     * @return void
     * @throws \App\Exceptions\PropertyNotFoundException | \App\Exceptions\PropertyIsNotArrayException
     */
    private function addScreeningIdToArrayData(int $screeningId, string $propertyName): void
    {
        if(!property_exists($this, $propertyName)){
            throw new PropertyNotFoundException("Property {$propertyName} is not found.");
        }

        if(!is_array($this->$propertyName)) throw new PropertyIsNotArrayException("Propertu {$propertyName} is not array.");

        $this->$propertyName = [
            'screening_id' => $screeningId,
            ...$this->$propertyName,
        ];
    }

    /**
     * Format the given date to the given format
     * @param string|null $date
     * @param string $format
     * @return string|null
     */
    private function formatDate(?string $date, string $format = 'Y/m/d'): ?string
    {
        if(is_null($date)) return null;

        return Carbon::parse($date)->format($format);
    }

    /**
     * Add screening id to all extra screening data
     * @param int|null $screeningId
     * @return void
     * @throws \App\Exceptions\PropertyNotFoundException
     */
    private function appendScreeningId(?int $screeningId): void
    {
        if(is_null($screeningId)) throw new QueryException('Screening id cannot be null.');

        $this->addScreeningIdToArrayData($screeningId, 'summaryData');
        $this->addScreeningIdToArrayData($screeningId, 'houseLoanSummaryConsertiveData');
        $this->addScreeningIdToArrayData($screeningId, 'houseLoanSummaryAggressiveData');
        $this->addScreeningIdToArrayData($screeningId, 'cashData');
        $this->addScreeningIdToArrayData($screeningId, 'commitmentCreditData');
        $this->addScreeningIdToArrayData($screeningId, 'screeningLatestResultData');

        $this->creditAssessmentData = array_map(function ($data) use ($screeningId) {
            return [
                'screening_id' => $screeningId,
                ...$data,
            ];
        }, $this->creditAssessmentData);

    }

    /**
     * store extra screening data to database
     * @return void
     */
    private function storeExtraScreeningData(): void
    {
        Summary::query()->create($this->summaryData);
        HouseLoanSummary::query()->create($this->houseLoanSummaryConsertiveData);
        HouseLoanSummary::query()->create($this->houseLoanSummaryAggressiveData);
        Cash::query()->create($this->cashData);
        CommitmentCredit::query()->create($this->commitmentCreditData);
        ScreeningLatestResult::query()->create($this->screeningLatestResultData);
        CreditAssessment::query()->insert($this->creditAssessmentData);
    }
}

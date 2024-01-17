<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\PropertyNotFoundException;
use App\Http\Controllers\Controller;
use App\Service\Api\ScreeningService;
use Illuminate\Http\Response;

class ScreeningInformationController extends Controller
{

    public function __construct(private ScreeningService $screeningApiService) {}

    /**
     * Store data from request to the database
     * @return void
     */
    public function store(): void
    {
        $screeningData                  = $this->getData('screening');
        $summaryData                    = $this->getData('summary');
        $houseLoanSummaryConsertiveData = $this->getData('house_loan_summary_consertive');
        $houseLoanSummaryAggressiveData = $this->getData('house_loan_summary_aggresive');
        $cashData                       = $this->getData('cash');
        $commitmentCreditData           = $this->getData('commitment_credit');
        $screeningLatestResultData      = $this->getData('screening_latest_result');
        $creditAssesmentData            = $this->getData('credit_assesment');

        try{
            $this->screeningApiService
                ->setScreeningData($screeningData)
                ->setSummaryData($summaryData)
                ->setHouseLoanSummaryData($houseLoanSummaryConsertiveData,'consertive')
                ->setHouseLoanSummaryData($houseLoanSummaryAggressiveData, 'agressive')
                ->setCashData($cashData)
                ->setCommitmentCreditData($commitmentCreditData)
                ->setScreeningLatestResultData($screeningLatestResultData)
                ->setCreditAssessmentData($creditAssesmentData)
                ->store();
        }catch (PropertyNotFoundException $e)
        {
            response()->json([
                'status' => false,
                'code'   => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => 'Failed to store the data.',
                'error'   => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR,)->throwResponse();
        }
    }

    /**
     * Get data from request and parse the data into associative array
     * @param string $key
     * @return array
     */
    private function getData(string $key): array
    {
        $data = request()->input($key) ?? [];

        return is_array($data) ? $data : json_decode($data, 1);
    }

}

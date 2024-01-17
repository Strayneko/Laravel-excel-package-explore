<div x-data="{showDetailModal: false}" x-on:show-detail-modal.window="showDetailModal = true">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    #
                </th>
                <th scope="col" class="px-6 py-3">
                    Screening Timestamp
                </th>
                <th scope="col" class="px-6 py-3">
                    Client Name
                </th>
                <th scope="col" class="px-6 py-3">
                    Ic
                </th>
                <th scope="col" class="px-6 py-3">
                    Email
                </th>
                <th scope="col" class="px-6 py-3">
                    Mobile Number
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>

            </tr>
            </thead>
            <tbody>
            @forelse($screenings as $screening)
                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ (($screenings->currentPage() - 1) * $screenings->perPage() + 1 ) + $loop->index}}
                    </th>
                    <td class="px-6 py-4">
                        {{ $screening->timestamp_screening }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $screening->client_name }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $screening->ic }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $screening->email }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $screening->mobile_number }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        <button title="Detail" class="group" wire:click="showDetailModal({{ $screening->id }})">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7 group-hover:fill-gray-800 group-hover:stroke-gray-800">
                                <path stroke-linecap="round" stroke-linejoin="round" class="group-hover:stroke-white" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                            </svg>
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center pt-2">No records found...</td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <div class="mx-2 my-4">
            {{ $screenings->links() }}
        </div>
    </div>

    <x-form.modal id="detail-modal" show-modal-name="showDetailModal" title="Screening Detail" size="4xl">
        @if(!is_null($screeningDetail))
            <div class="pb-5 border-b border-gray-300">
                <h3 class="text-gray-800 text-lg">Screening Detail</h3>
                <table>
                    @foreach($screeningColumns as $column)
                        <tr>
                            <td class="text-gray-800">{{ $this->formatColumnName($column) }}</td>
                            <td class="text-gray-800">: {{ $screeningDetail[$column] ?? 'N/A' }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>

            <div class="pb-5 border-b border-gray-300">
                <h3 class="text-gray-800 text-lg">Summary</h3>
                <table>
                    @foreach($summaryColumns as $column)
                        <tr>
                            <td class="text-gray-800">{{ $this->formatColumnName($column) }}</td>
                            <td class="text-gray-800">: {{ $screeningDetail['summary'][$column] ?? 'N/A' }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>

            <div class="pb-5 border-b border-gray-300">
                <h3 class="text-gray-800 text-lg">House Loan Summary Conservative</h3>
                <table>
                    @foreach($houseLoanSummaryColumns as $column)
                        <tr>
                            <td class="text-gray-800">{{ $this->formatColumnName($column) }}</td>
                            <td class="text-gray-800">: {{ $houseLoanConservative[$column] ?? 'N/A' }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>

            <div class="pb-5 border-b border-gray-300">
                <h3 class="text-gray-800 text-lg">House Loan Summary Aggressive</h3>
                <table>
                    @foreach($houseLoanSummaryColumns as $column)
                        <tr>
                            <td class="text-gray-800">{{ $this->formatColumnName($column) }}</td>
                            <td class="text-gray-800">: {{ $houseLoanAggressive[$column] ?? 'N/A' }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>

            <div class="pb-5 border-b border-gray-300">
                <h3 class="text-gray-800 text-lg">Cash Detail</h3>
                <table>
                    @foreach($cashColumns as $column)
                        <tr>
                            <td class="text-gray-800">{{ $this->formatColumnName($column) }}</td>
                            <td class="text-gray-800">: {{ $screeningDetail['cash'][$column] ?? 'N/A' }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>

            <div class="pb-5 border-b border-gray-300">
                <h3 class="text-gray-800 text-lg">Commitment Credit</h3>
                <table>
                    @foreach($commitmentCreditColumns as $column)
                        <tr>
                            <td class="text-gray-800">{{ $this->formatColumnName($column) }}</td>
                            <td class="text-gray-800">: {{ $screeningDetail['commitmentCredit'][$column] ?? 'N/A' }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>

            <div class="pb-5 border-b border-gray-300">
                <h3 class="text-gray-800 text-lg">Screening Latest Result</h3>
                <table>
                    @foreach($screeningLatestResultColumns as $column)
                        <tr>
                            <td class="text-gray-800">{{ $this->formatColumnName($column) }}</td>
                            <td class="text-gray-800">: {{ $screeningDetail['screeningLatestResult'][$column] ?? 'N/A' }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>

            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        #
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Credit Assessment ID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Status
                    </th>

                </tr>
                </thead>
                <tbody>
                @forelse($screeningDetail['creditAssessments'] as $credit)
                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $loop->iteration }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $credit->credit_assessment_id ?? 'N/A' }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $credit->status ?? 'N/A' }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center pt-2">No records found...</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        @endif


    </x-form.modal>
</div>

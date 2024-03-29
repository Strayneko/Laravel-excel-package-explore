<div x-data="{showModal: false}">

    <button @click.prevent="showModal = true" type="button" class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Export</button>
    <x-form.modal id="export-modal" title="Export Document" show-modal-name="showModal">
                <!-- Modal body -->
                <div class="p-4 md:p-5 space-y-4">
                    <div wire:loading.remove wire:target="export">
                            <div>
                                <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Export As</label>
                                <select id="countries" wire:model="form.exportType" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="csv">CSV</option>
                                    <option value="xlsx">Excel (xlsx)</option>
                                </select>

                                <x-form.error model="form.exportType" />
                            </div>

                            <div>
                                <div class="text-dark-900 text-sm mb-2">Select Columns to export</div>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($columns as $column)
                                    <div class="flex items-center mb-4">
                                        <input id="column-{{ $column }}"
                                               wire:key="input-{{ $column }}"
                                               type="checkbox"
                                               value="{{ $column }}"
                                               class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                               wire:model="form.selectedColumn"
                                        >
                                        <label for="column-{{ $column }}" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $column }}</label>
                                    </div>
                                    @endforeach
                                </div>

                                @error('form.selectedColumn')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                <div class="mx-4 flex justify-center mb-4">
                    <div  wire:loading wire:target="export">
                    <div class="flex flex-col items-center">
                        <h1 class="text-gray-900">Exporting as {{ $form->exportType }}</h1>
                        <div>
                            <span class="text-gray-900" wire:stream="currentRow">{{ $currentRow }}</span>
                            <span class="text-gray-900">/{{ $totalRow }} Row</span>
                        </div>

                        <div>
                            <svg class="animate-spin -ml-1 mr-3 h-20 w-20 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </div>
                    </div>
                    </div>
                </div>

            <x-slot:footer>
                    <button data-modal-hide="default-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel</button>
                    <button data-modal-hide="default-modal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            wire:click.prevent="export"
                    >Export</button>
            </x-slot:footer>
    </x-form.modal>
</div>

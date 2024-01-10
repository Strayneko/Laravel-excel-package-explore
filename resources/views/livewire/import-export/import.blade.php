<div x-data="{
showModal: false,
}" x-on:import-finished.window="showModal = false">
    <button @click.prevent="showModal = true" type="button" class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Import</button>
    <x-form.modal id="import-modal" show-modal-name="showModal" title="Import Modal">
        <div>
            <div wire:loading.remove wire:target="import">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Upload document to import</label>
                <input wire:model="form.file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="file_input" type="file">
                <x-form.error model="form.file" />
            </div>

            <div class="mx-4 flex justify-center mb-4">
                <div  wire:loading wire:target="import">
                    <div class="flex flex-col items-center">
                            <h1 class="text-gray-900">Importing Document</h1>
                        <div>
                            <span class="text-gray-900" wire:stream="currentRow">{{ $currentRow }}</span>
                            <span class="text-gray-900">/</span>
                            <span class="text-gray-900" wire:stream="totalRows">{{ $totalRows }} Row</span>
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
        </div>

        <x-slot:footer>
            <button @click.prevent="showModal = false"
                    type="button"
                    class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 disabled:bg-gray-300 disabled:cursor-not-allowed hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600"
                    wire:loading.attr="disabled"
            >
                Cancel
            </button>
            <button type="button"
                    class="text-white bg-gray-800 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center disabled:cursor-not-allowed disabled:bg-gray-700 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    wire:click.prevent="import"
                    wire:loading.attr="disabled"
                    wire:target="import,form.file"
            >Import</button>
        </x-slot:footer>
    </x-form.modal>
</div>

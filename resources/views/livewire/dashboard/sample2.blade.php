<div>
    <h1 class="text-gray-900 text-xl">Sample 2: Merge Template</h1>
    <livewire:dashboard.sample2.movie-records />


    <form action="" wire:submit="submit">
        <div class="mt-6">
            <h3 class="text-gray-900 text-xl">Test Merge</h3>
            <div class="flex gap-2">
                <div class="w-1/2">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Upload Template 1</label>
                    <input class="block text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer w-full bg-gray-50" id="file_input" wire:model="form.file" type="file">
                    <div>
                        <span class="text-red-500">
                            @error('form.file')
                            {{ $message }}
                            @enderror
                        </span>
                    </div>
                </div>
                <div class="w-1/2">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Upload Template 2</label>
                    <input class="block text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer w-full bg-gray-50" id="file_input" wire:model="form.file2" type="file">
                    <div>
                        <span class="text-red-500">
                            @error('form.file2')
                            {{ $message }}
                            @enderror
                        </span>
                    </div>
                </div>
            </div>

            <button class="bg-gray-800 mt-1 text-white rounded px-2 py-1 hover:bg-gray-800/80 disabled:bg-gray-800/80 disabled:cursor-not-allowed"
                    wire:loading.attr="disabled"
                    wire:target="submit"
            >
                <span wire:loading.remove wire:target="submit">Process</span>
                <span wire:loading wire:target="submit">Processing</span>
            </button>
        </div>

    </form>
</div>

<div>
    <h1 class="text-gray-900 text-xl">Sample 1: One Dimensional Table</h1>
    <livewire:dashboard.sample1.salary-records />

    <form action="" wire:submit="submit">
        <div class="mt-6">
            <h3 class="text-gray-900 text-xl">Test export</h3>
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Upload Template</label>
            <input class="block text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer w-1/2 bg-gray-50" id="file_input" wire:model="form.file" type="file">
            <div>
                        <span class="text-red-500">
                            @error('form.file')
                            {{ $message }}
                            @enderror
                        </span>
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

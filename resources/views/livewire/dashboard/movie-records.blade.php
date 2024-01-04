<div>


    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    #
                </th>
                <th scope="col" class="px-6 py-3">
                    Title
                </th>
                <th scope="col" class="px-6 py-3">
                    Producer
                </th>
                <th scope="col" class="px-6 py-3">
                    Production Fee
                </th>
                <th scope="col" class="px-6 py-3">
                    Revenue
                </th>
                <th scope="col" class="px-6 py-3">
                    Release Date
                </th>

            </tr>
            </thead>
            <tbody>
            @foreach($movies as $movie)
                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ (($movies->currentPage() - 1) * $movies->perPage() + 1 ) + $loop->index}}
                    </th>
                    <td class="px-6 py-4">
                        {{ $movie->title }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $movie->producer }}
                    </td>
                    <td class="px-6 py-4">
                        ${{ number_format($movie->production_fee) }}
                    </td>
                    <td class="px-6 py-4">
                        ${{ number_format($movie->revenue) }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $this->formatDate($movie->release_date) }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="mx-2 my-4">
            {{ $movies->appends('salary-page')->links() }}
        </div>
    </div>


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

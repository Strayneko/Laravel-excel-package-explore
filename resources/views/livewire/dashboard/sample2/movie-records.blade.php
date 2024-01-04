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

</div>

<div>


    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    #
                </th>                <th scope="col" class="px-6 py-3">
                    Name
                </th>
                <th scope="col" class="px-6 py-3">
                    Base Salary
                </th>
                <th scope="col" class="px-6 py-3">
                    Bonus Salary
                </th>
            </tr>
            </thead>
            <tbody>
            @forelse($salaries as $salary)
                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ (($salaries->currentPage() - 1) * $salaries->perPage() + 1 ) + $loop->index}}
                    </th>
                    <td class="px-6 py-4">
                        {{ $salary->name }}
                    </td>
                    <td class="px-6 py-4">
                        ${{ number_format($salary->base_salary) }}
                    </td>
                    <td class="px-6 py-4">
                        ${{ number_format($salary->bonus) }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center pt-2">No records found...</td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <div class="mx-2 my-4">
            {{ $salaries->links() }}
        </div>
    </div>

</div>

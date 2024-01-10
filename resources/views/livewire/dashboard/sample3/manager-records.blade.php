<div>


    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    #
                </th>
                @foreach($managers['managers']['titles'][0] as $manager)
                    <th scope="col" class="px-6 py-3">
                        {{ $manager }}
                    </th>
                @endforeach

            </tr>
            </thead>
            <tbody>
            @foreach($managers['managers']['values'] as $manager)
                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $manager['month'] }}
                    </th>
                    @foreach($manager['amount'] as $amount)
                        <td class="px-6 py-4">
                            {{ $amount }}
                        </td>
                    @endforeach
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>

</div>

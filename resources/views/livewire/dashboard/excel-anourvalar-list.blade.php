<div>
    <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
        <h1 class="mt-8 text-2xl font-medium text-gray-900">
            Experiment Data Pipelines with AnourValar/office package
        </h1>

        <div class="text-sm font-medium text-center mb-10 text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700">
            <ul class="flex flex-wrap -mb-px">
                <li class="me-2">
                    <a href="#" wire:click.prevent="goToSample(1)" @class(['active-tab' => $samplePage === '1', 'inactive-tab' => $samplePage !== '1'])>Sample 1</a>
                </li>
                <li class="me-2">
                    <a href="#" wire:click.prevent="goToSample(2)" @class(['active-tab' => $samplePage === '2', 'inactive-tab' => $samplePage !== '2'])>Sample 2</a>
                </li>
                <li class="me-2">
                    <a href="#" wire:click.prevent="goToSample(3)" @class(['active-tab' => $samplePage === '3', 'inactive-tab' => $samplePage !== '3'])>Sample 3</a>
                </li>
            </ul>
        </div>

        @if($samplePage === '1')
            <livewire:dashboard.sample1 />
        @elseif($samplePage === '2')
            <livewire:dashboard.sample2 />
        @elseif($samplePage === '3')
            <livewire:dashboard.sample3 />
        @else
            <span>Page not valid</span>
        @endif
    </div>


</div>

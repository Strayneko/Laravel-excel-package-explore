@props([
    'submitMethod' => 'submit',
    'formTitle',
    'fileLabel1',
    'fileLabel2',
    'fileModel1',
    'fileModel2' => '',
    'isDualUpload' => false,
    'buttonLabel' => 'Process',
    'buttonLoadLabel' => 'Processing',
])
<div>
    <form action="" wire:submit="{{ $submitMethod }}">
        <div class="mt-6">
            <h3 class="text-gray-900 text-xl">{{ $formTitle }}</h3>
            <div class="flex gap-2">
                <div class="w-1/2">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">{{ $fileLabel1 }}</label>
                    <input {{ $attributes->merge([
                            'class' => 'block text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer w-full bg-gray-50',
                     ]) }}
                           id="{{ str_replace('.', '_', $fileModel1) }}"
                           wire:model="{{ $fileModel1 }}"
                           type="file"
                    >
                    <div>
                        <x-form.error model="fileModel1" />
                    </div>
                </div>
                @if($isDualUpload)
                    <div class="w-1/2">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">{{ $fileLabel2 }}</label>
                        <input {{ $attributes->merge([
                            'class' => 'block text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer w-full bg-gray-50',
                     ]) }}
                               id="{{ str_replace('.', '_', $fileModel2) }}"
                               wire:model="{{ $fileModel2 }}"
                               type="file"
                        >
                        <div>
                        <x-form.error model="fileModel2" />
                        </div>
                    </div>
               @endif
            </div>

            <button class="bg-gray-800 mt-1 text-white rounded px-2 py-1 hover:bg-gray-800/80 disabled:bg-gray-800/80 disabled:cursor-not-allowed"
                    wire:loading.attr="disabled"
                    wire:target="{{ $submitMethod }}"
            >
                <span wire:loading.remove wire:target="{{ $submitMethod }}">{{ $buttonLabel }}</span>
                <span wire:loading wire:target="{{ $submitMethod }}">{{ $buttonLoadLabel }}</span>
            </button>
        </div>

    </form>
</div>

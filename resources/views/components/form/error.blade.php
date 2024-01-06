@props(['model'])

@error($model)
    <span class="text-red-500">{{ $message }}</span>
@enderror

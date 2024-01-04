<div>
    <h1 class="text-gray-900 text-xl">Sample 3: Two Dimensional Table</h1>
    <livewire:dashboard.sample3.manager-records :managers="$managers" />

    <x-form.template-uploader form-title="Export Two Dimensional Table"
                              file-label1="Upload Template"
                              file-model1="form.file"
    />
</div>

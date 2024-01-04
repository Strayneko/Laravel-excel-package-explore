<div>
    <h1 class="text-gray-900 text-xl">Sample 2: Merge Template</h1>
    <livewire:dashboard.sample2.movie-records />

    <x-form.template-uploader :is-dual-upload="true"
                              file-model1="form.file"
                              file-model2="form.file2"
                              file-label1="Upload Template 1"
                              file-label2="Upload Template 2"
                              form-title="Test Merge"
    />
</div>

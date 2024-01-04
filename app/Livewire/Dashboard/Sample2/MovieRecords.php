<?php

namespace App\Livewire\Dashboard\Sample2;

use App\Models\Movie;
use App\Traits\WithDateFormat;
use Livewire\Component;
use Livewire\WithPagination;

class MovieRecords extends Component
{
    use WithPagination, WithDateFormat;

    public function render()
    {
        $movies = Movie::query()
                       ->select('title', 'producer', 'production_fee', 'revenue', 'release_date')
                       ->paginate(perPage: 10, pageName: 'movie-page');
        return view('livewire.dashboard.sample2.movie-records', compact('movies'));
    }
}

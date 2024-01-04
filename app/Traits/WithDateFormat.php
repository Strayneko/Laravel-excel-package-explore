<?php

namespace App\Traits;
use Illuminate\Support\Carbon;

trait WithDateFormat
{
    /**
     * Format date to the specific format
     * @param string $date
     * @param string $format
     * @return string
     */
    public function formatDate(string $date, string $format = 'd F Y'): string
    {
        return Carbon::parse($date)->format($format);
    }
}

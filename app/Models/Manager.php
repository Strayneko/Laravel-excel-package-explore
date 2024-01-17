<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Manager extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function managerValues(): HasMany
    {
        return $this->hasMany(ManagerValue::class);
    }
}

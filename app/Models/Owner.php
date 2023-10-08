<?php

namespace App\Models;

use App\Models\Patient;
use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Owner extends Model
{
    use HasFactory, SoftDeletes, Userstamps;

    public function patients(): HasMany
    {
        return $this->hasMany(Patient::class);
    }
}

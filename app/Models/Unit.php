<?php

namespace App\Models;

use App\Traits\FilterableSortable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory, FilterableSortable;

    protected $table = 'units';

    protected $fillable = [
        'full_name',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    protected $filterable = [
        'full_name',
    ];
}

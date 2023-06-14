<?php

namespace App\Models;

use App\Traits\FilterableSortable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unit extends Model
{
    use HasFactory, FilterableSortable, SoftDeletes;

    protected $table = 'units';

    protected $fillable = [
        'description',
        'fantasy_name',
        'social_name',
        'cnpj',
        'email',
        'phone',
        'cellphone',
        'facebook',
        'twitter',
        'instagram',
        'youtube',
    ];

    protected $filterable = [
        'description',
    ];

    public function setCnpjAttribute($value)
    {
        $this->attributes['cnpj'] = preg_replace('/[^0-9]/', '', $value);
    }
}

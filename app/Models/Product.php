<?php

namespace App\Models;

use Freshbitsweb\LaravelCartManager\Traits\Cartable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, Cartable;

    protected $fillable = [
        'name',
        'brand',
        'price'
    ];
}

<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bracelet extends Model
{
    use HasFactory;

    protected $table = 'bracelets';

    protected $fillable = [
        'id',
        'name',
        'quantity_remain',
        'cost',
        'lower_cost',
        'image'
    ];
}

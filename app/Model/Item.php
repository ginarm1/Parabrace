<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $table = 'items';

    protected $fillable = [
        'id',
        'user_id',
        'name',
        'image',
        'quantity',
        'cost',
        'sold',
        'order_id'
    ];

    public function bracelet () {
        return $this -> hasOne(Bracelet::class);
    }
}

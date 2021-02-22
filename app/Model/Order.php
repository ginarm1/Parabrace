<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'id',
        'user_id',
        'item_id',
        'total_cost',
        'country',
        'city',
        'address',
        'phone_nr'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
    public function items() {
        return $this->hasMany(User::class);
    }
}

<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;

    protected $table = 'partners';

    protected $fillable = [
        'id',
        'name',
        'url'

    ];
    public $timestamps = false;

    public function articles(){
        return $this ->belongsToMany(Partner::class)->withTimestamps();
    }
}

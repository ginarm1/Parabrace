<?php

namespace App\Model;

use App\Model\Partner;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $table = 'articles';

    protected $fillable =[
        'id',
        'name',
        'intro',
        'text',
        'image'
    ];


    public function partners(){
        return $this->belongsToMany(Partner::class,'article_partner')->withTimestamps();
    }
}

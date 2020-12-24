<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article_partner extends Model
{
    use HasFactory;
    protected $table = 'Article_partner';

    protected $fillable =[
        'article_id',
        'partner_id'
    ];
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $fullImg = 'storage/img/articles/'. $this -> image;
        $readMore = "./articles/".$this -> id;
        return [
            'id' => $this -> id,
            'name' => $this -> name,
            'intro' => $this -> intro,
            'text' => $this -> text,
            'image' => $this -> image = $fullImg,
            'show' => $this -> show = false,
            'readMore' => $this -> readMore = $readMore
        ];


    }
    public function with($request) {
        return [
            'author' => 'Gintaras Armonaitis 2021'
        ];
    }
}

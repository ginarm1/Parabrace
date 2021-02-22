<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $fullImg = 'storage/img/bracelets/'. $this -> image;

        return [
            'id' => $this -> id,
            'name' => $this -> name,
            'user_id' => $this -> user_id,
            'quantity' => $this -> quantity,
            'image' => $this -> image = $fullImg,
            'cost' => $this -> cost,
            'sold' => $this -> sold,
        ];
    }
}

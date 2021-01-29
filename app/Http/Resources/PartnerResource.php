<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PartnerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $fullUrl = 'https://'. $this -> url;
        return [
            'id' => $this -> id,
            'name' => $this -> name,
            'url' => $this -> name = $fullUrl
        ];
    }
}

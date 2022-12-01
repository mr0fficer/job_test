<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request)
    {

        $categories = $this->categories()->get();

        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'categories' =>  $categories
        ];
    }
}

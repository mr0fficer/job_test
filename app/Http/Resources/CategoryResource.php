<?php

namespace App\Http\Resources;

use App\Models\Category;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    public function toArray($request)
    {
        $parent_name = null;

        if ($this->parent_id) {
            $parent = Category::find($this->parent_id);
            if ($parent) {
                $parent_name = $parent->name;
            }
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'parent_id' => $this->parent_id,
            'parent_name' => $parent_name,
        ];
    }
}

<?php

namespace App\Http\Resources;

use App\Models\Technique;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TechniqueResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'name_fa'=>$this->name_fa,
            'name_en'=>$this->name_en,
            'description'=>$this->description,
        ];
    }
}

<?php

namespace App\Http\Resources;

use App\Models\Style;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SellResource extends JsonResource
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
            'project'=>$this->project->name_fa,
            'price'=>$this->price,
            'count'=>$this->count,
            'location'=>$this->location,
            'address'=>$this->address,
            'phone'=>$this->phone,
            'description'=>$this->description,
        ];
    }
}

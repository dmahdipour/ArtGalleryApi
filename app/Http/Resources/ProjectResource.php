<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
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
            'member'=>$this->member->name,
            'name_fa'=>$this->name_fa,
            'name_en'=>$this->name_en,
            'technique_fa'=>$this->technique->name_fa,
            'technique_en'=>$this->technique->name_en,
            'style_fa'=>$this->style->name_fa,
            'style_en'=>$this->style->name_en,
            'subject_fa'=>$this->subject->name_fa,
            'subject_en'=>$this->subject->name_en,
            'height'=>$this->height,
            'width'=>$this->width,
            'year'=>$this->year,
            'image'=>$this->image,
            'thumbnail'=>$this->thumbnail,
            'artist_describe'=>$this->artist_describe,
            'describe'=>$this->describe,
            'about'=>$this->about,
            'signature'=>$this->signature,
            'theme'=>$this->theme,
        ];
    }
}

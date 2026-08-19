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
            'member_fa'=>$this->member->name_fa,
            'member_en'=>$this->member->name_en,
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
            'image'=>env('APP_URL').'/storage/'.$this->image,
            'thumbnail'=>env('APP_URL').'/storage/'.$this->thumbnail,
            'artist_describe'=>$this->member_description,
            'description'=>$this->description,
            'about_project'=>$this->about_project,
            'about_artist'=>$this->member->about,
            'signature'=>env('APP_URL').'/storage/'.$this->signature,
            'status'=>$this->status,
            'theme'=>$this->theme,
        ];
    }
}

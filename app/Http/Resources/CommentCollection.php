<?php

namespace App\Http\Resources;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CommentCollection extends ResourceCollection
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
            'project_id'=>$this->project_id,
            'sender_name'=>$this->sender_name,
            'sender_contact'=>$this->sender_contact,
            'is_confirmed'=>$this->is_confirmed,
            'is_read'=>$this->is_read,
        ];
    }
}

<?php

namespace App\Http\Resources;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class MemberResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $dt=Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('j F Y');
        
        return [
            'token'=>$this->token,
            'name'=>$this->name,
            'user_name'=>$this->user_name,
            'avatar'=>env('APP_URL').'/storage/'.$this->avatar,
            'birthday'=>$this->birthday,
            'place'=>$this->place,
            'major'=>$this->major,
            'university'=>$this->university,
            'activites'=>$this->activities,
            'email'=>$this->email,
            'phone'=>$this->phone,
            'instagram'=>$this->instagram,
            'linkedin'=>$this->linkedin,
            'status'=>$this->status,
            'register_date'=>$dt,
        ];
    }
}

<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\MemberTypeResource;
use App\Models\MemberType;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MemberTypeController extends Controller
{
    public function index()
    {
        $items= MemberType::get()->latest(); 
        if($items)   
        {
            return response()->json(['data' => ['data' => MemberTypeResource::collection($items)]], 200);
        }
        return response()->json(['error' => 'هیچ نوع کاربری وجود ندارد.'], 400);
    }


    public function info(Request $request)
    {
        $item = MemberType::where('id', $request->id)->get()->first(); 
        if($item)   
        {
            return response()->json(['data' => ['data' => new MemberTypeResource($item)]], 200);
        }
        return response()->json(['error' => 'چنین پروژه ای وجود ندارد.'], 400);
        
    }
}

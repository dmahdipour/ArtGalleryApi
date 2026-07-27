<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\StyleResource;
use App\Models\Style;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StyleController extends Controller
{
    public function index()
    {
        $items= Style::get()->latest(); 
        if($items)   
        {
            return response()->json(['data' => ['data' => StyleResource::collection($items)]], 200);
        }
        return response()->json(['error' => 'هیچ سبکی وجود ندارد.'], 400);
    }


    public function info(Request $request)
    {
        $item = Style::where('id', $request->id)->get()->first(); 
        if($item)   
        {
            return response()->json(['data' => ['data' => new StyleResource($item)]], 200);
        }
        return response()->json(['error' => 'چنین سبکی وجود ندارد.'], 400);
        
    }
}

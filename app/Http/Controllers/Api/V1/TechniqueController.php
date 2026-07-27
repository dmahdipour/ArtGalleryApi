<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\TechniqueResource;
use App\Models\Technique;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TechniqueController extends Controller
{
    public function index()
    {
        $items= Technique::get()->latest(); 
        if($items)   
        {
            return response()->json(['data' => ['data' => TechniqueResource::collection($items)]], 200);
        }
        return response()->json(['error' => 'هیچ تکنیکی وجود ندارد.'], 400);
    }


    public function info(Request $request)
    {
        $item = Technique::where('id', $request->id)->get()->first(); 
        if($item)   
        {
            return response()->json(['data' => ['data' => new TechniqueResource($item)]], 200);
        }
        return response()->json(['error' => 'چنین تکنیکی وجود ندارد.'], 400);
        
    }
}

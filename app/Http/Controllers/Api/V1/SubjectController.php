<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\SubjectResource;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SubjectController extends Controller
{
    public function index()
    {
        $items= Subject::get()->latest(); 
        if($items)   
        {
            return response()->json(['data' => ['data' => SubjectResource::collection($items)]], 200);
        }
        return response()->json(['error' => 'هیچ موضوعی وجود ندارد.'], 400);
    }


    public function info(Request $request)
    {
        $item = Subject::where('id', $request->id)->get()->first(); 
        if($item)   
        {
            return response()->json(['data' => ['data' => new SubjectResource($item)]], 200);
        }
        return response()->json(['error' => 'چنین موضوعی وجود ندارد.'], 400);
        
    }
}

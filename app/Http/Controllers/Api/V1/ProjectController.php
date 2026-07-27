<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProjectController extends Controller
{
    public function index()
    {
        $items= Project::get()->latest(); 
        if($items)   
        {
            return response()->json(['data' => ['data' => new ProjectResource($items)]], 200);
        }
        return response()->json(['error' => 'هیچ پروژه ای وجود ندارد.'], 400);
    }


    public function info(Request $request)
    {
        $item = Project::where('id', $request->id)->get()->first(); 
        if($item)   
        {
            return response()->json(['data' => ['data' => new ProjectResource($item)]], 200);
        }
        return response()->json(['error' => 'چنین پروژه ای وجود ندارد.'], 400);
        
    }
}

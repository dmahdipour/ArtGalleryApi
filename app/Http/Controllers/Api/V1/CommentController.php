<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CommentController extends Controller
{
    public function index()
    {
        $items= Comment::get()->latest(); 
        if($items)   
        {
            return response()->json(['data' => ['data' => CommentResource::collection($items)]], 200);
        }
        return response()->json(['error' => 'هیچ کامنتی وجود ندارد.'], 400);
    }


    public function info(Request $request)
    {
        $item = Comment::where('id', $request->id)->get()->first(); 
        if($item)   
        {
            return response()->json(['data' => ['data' => new CommentResource($item)]], 200);
        }
        return response()->json(['error' => 'چنین کامنتی وجود ندارد.'], 400);
        
    }
}

<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->project_id) {
            return response()->json(['error' => 'ورود آی دی پروژه اجباری است.'], 400);
        }
        $comments = Comment::with(['replies' => function ($query) {
            $query;
        }])
        ->where('project_id', $request->project_id)
        ->whereNull('parent_id')
        ->orderBy('created_at', 'desc')
        ->get();

        if($comments)   
        {
            //return response()->json(['data' => $comments], 200);
            return response()->json(['data' => CommentResource::collection($comments)], 200);
        }
        return response()->json(['error' => 'هیچ کامنتی برای این پروژه وجود ندارد.'], 400);
    }


    public function info(Request $request)
    {
        if (!$request->id) {
            return response()->json(['error' => 'هیچ آی دی برای نظر وارد نشده است.'], 400);
        }
        $item = Comment::where('id', $request->id)->get()->first(); 
        if($item)   
        {
            return response()->json(['data' => new CommentResource($item)], 200);
        }
        return response()->json(['error' => 'چنین کامنتی وجود ندارد.'], 400);
    }
    
    
    public function markAsRead(Request $request)
    {
        if (!$request->id) {
            return response()->json(['error' => 'هیچ آی دی برای نظر وارد نشده است.'], 400);
        }
        $item = Comment::where('id', $request->id)->get()->first(); 
        if (!$item) {
            return response()->json(['error' => 'چنین نظری وجود ندارد.'], 400);
        }
        $res = $item->update(['is_read'=>1]);

        if($res)
        {
            $item = Comment::where('id', $request->id)->get()->first(); 
            return response()->json(['data' => new CommentResource($item)], 200);
        }
        return response()->json(['error' => 'خطا در ویرایش نظر'], 400);
    } 


    
    public function markAsPublished(Request $request)
    {
        if (!$request->id) {
            return response()->json(['error' => 'هیچ آی دی برای نظر وارد نشده است.'], 400);
        }
        $item = Comment::where('id', $request->id)->get()->first(); 
        if (!$item) {
            return response()->json(['error' => 'چنین نظری وجود ندارد.'], 400);
        }
        $res = $item->update(['is_published'=>1]);

        if($res)
        {
            $item = Comment::where('id', $request->id)->get()->first(); 
            return response()->json(['data' => new CommentResource($item)], 200);
        }
        return response()->json(['error' => 'خطا در ویرایش نظر'], 400);
    }

    
    
    public function update(Request $request)
    {
        if (!$request->id) {
            return response()->json(['error' => 'هیچ آی دی برای نظر وارد نشده است.'], 400);
        }
        $item = Comment::where('id', $request->id)->get()->first(); 
        if (!$item) {
            return response()->json(['error' => 'چنین نظری وجود ندارد.'], 400);
        }
        $res = $item->update($request->all());

        if($res)
        {
            $item = Comment::where('id', $request->id)->get()->first(); 
            return response()->json(['data' => new CommentResource($item)], 200);
        }
        return response()->json(['error' => 'خطا در ویرایش نظر'], 400);
    } 
    

    public function delete(Request $request)
    {
        if (!$request->id) {
            return response()->json(['error' => 'هیچ آی دی برای نظر وارد نشده است.'], 400);
        }
        $item = Comment::where('id', $request->id)->get()->first(); 
        if (!$item) {
            return response()->json(['error' => 'چنین نظری وجود ندارد.'], 400);
        }
        $res = $item->delete();

        if($res)
        {
            return response()->json(['data' => ['message'=>'نظر با موفقیت حذف گردید.']], 200);
        }
        return response()->json(['error' => 'خطا در ویرایش نظر'], 400);
    } 
}

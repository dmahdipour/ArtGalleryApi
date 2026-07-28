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
        $items= MemberType::latest()->get(); 
        if($items)   
        {
            return response()->json(['data' => MemberTypeResource::collection($items)], 200);
        }
        return response()->json(['error' => 'هیچ نوع کاربری وجود ندارد.'], 400);
    }


    public function info(Request $request)
    {
        if (!$request->id) {
            return response()->json(['error' => 'هیچ آی دی برای نوع کاربری وارد نشده است.'], 400);
        }
        $item = MemberType::where('id', $request->id)->get()->first(); 
        if($item)   
        {
            return response()->json(['data' => new MemberTypeResource($item)], 200);
        }
        return response()->json(['error' => 'چنین نوع کاربری وجود ندارد.'], 400);
        
    }


    public function add(Request $request)
    {
        if (!$request->name) {
            return response()->json(['error' => 'هیچ نامی برای نوع کاربری وارد نشده است.'], 400);
        }
        $item = MemberType::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return $item;
        if($item)
        {
            return response()->json(['data' => ['message' => 'نوع کاربری با موفقیت ایجاد شد']], 200);
        }
        return response()->json(['error' => 'خطا در ایجاد نوع کاربری'], 400);
        
    }   
    
    
    public function update(Request $request)
    {
        if (!$request->id) {
            return response()->json(['error' => 'هیچ آی دی برای نوع کاربری وارد نشده است.'], 400);
        }
        if (!$request->name) {
            return response()->json(['error' => 'هیچ نامی برای نوع کاربری وارد نشده است.'], 400);
        }
        $item = MemberType::where('id', $request->id)->get()->first(); 
        if (!$item) {
            return response()->json(['error' => 'چنین نوع کاربری وجود ندارد.'], 400);
        }
        $res = $item->update($request->all());

        if($res)
        {
            $item = MemberType::where('id', $request->id)->get()->first(); 
            return response()->json(['data' => new MemberTypeResource($item)], 200);
        }
        return response()->json(['error' => 'خطا در ویرایش نوع کاربری'], 400);
    } 
    

    public function delete(Request $request)
    {
        if (!$request->id) {
            return response()->json(['error' => 'هیچ آی دی برای نوع کاربری وارد نشده است.'], 400);
        }
        $item = MemberType::where('id', $request->id)->get()->first(); 
        if (!$item) {
            return response()->json(['error' => 'چنین نوع کاربری وجود ندارد.'], 400);
        }
        $res = $item->delete();

        if($res)
        {
            return response()->json(['data' => ['message'=>'نوع کاربری با موفقیت حذف گردید.']], 200);
        }
        return response()->json(['error' => 'خطا در ویرایش نوع کاربری'], 400);
    } 
}

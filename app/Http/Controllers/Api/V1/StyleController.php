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
        $items= Style::latest()->get(); 
        if($items)   
        {
            return response()->json(['data' => StyleResource::collection($items)], 200);
        }
        return response()->json(['error' => 'هیچ سبکی وجود ندارد.'], 400);
    }


    public function info(Request $request)
    {
        if (!$request->id) {
            return response()->json(['error' => 'هیچ آی دی برای سبک وارد نشده است.'], 400);
        }
        $item = Style::where('id', $request->id)->get()->first(); 
        if($item)   
        {
            return response()->json(['data' => new StyleResource($item)], 200);
        }
        return response()->json(['error' => 'چنین سبکی وجود ندارد.'], 400);
        
    }
    
    
    public function update(Request $request)
    {
        if (!$request->id) {
            return response()->json(['error' => 'هیچ آی دی برای سبک وارد نشده است.'], 400);
        }
        if (!$request->name) {
            return response()->json(['error' => 'هیچ نامی برای سبک وارد نشده است.'], 400);
        }
        $item = Style::where('id', $request->id)->get()->first(); 
        if (!$item) {
            return response()->json(['error' => 'چنین سبکی وجود ندارد.'], 400);
        }
        $res = $item->update($request->all());

        if($res)
        {
            $item = Style::where('id', $request->id)->get()->first(); 
            return response()->json(['data' => new StyleResource($item)], 200);
        }
        return response()->json(['error' => 'خطا در ویرایش سبک'], 400);
    } 
    

    public function delete(Request $request)
    {
        if (!$request->id) {
            return response()->json(['error' => 'هیچ آی دی برای سبک وارد نشده است.'], 400);
        }
        $item = Style::where('id', $request->id)->get()->first(); 
        if (!$item) {
            return response()->json(['error' => 'چنین سبکی وجود ندارد.'], 400);
        }
        $res = $item->delete();

        if($res)
        {
            return response()->json(['data' => ['message'=>'سبک با موفقیت حذف گردید.']], 200);
        }
        return response()->json(['error' => 'خطا در ویرایش سبک'], 400);
    } 
}

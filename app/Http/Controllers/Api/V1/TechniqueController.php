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
        $items= Technique::latest()->get(); 
        if($items)   
        {
            return response()->json(['data' => TechniqueResource::collection($items)], 200);
        }
        return response()->json(['error' => 'هیچ تکنیکی وجود ندارد.'], 400);
    }


    public function info(Request $request)
    {
        if (!$request->id) {
            return response()->json(['error' => 'هیج آی دی برای تکنیک وارد نشده است.'], 400);
        }
        $item = Technique::where('id', $request->id)->get()->first(); 
        if($item)   
        {
            return response()->json(['data' => new TechniqueResource($item)], 200);
        }
        return response()->json(['error' => 'چنین تکنیکی وجود ندارد.'], 400);
        
    } 
    
    
    public function update(Request $request)
    {
        if (!$request->id) {
            return response()->json(['error' => 'هیچ آی دی برای تکنیک وارد نشده است.'], 400);
        }
        if (!$request->name) {
            return response()->json(['error' => 'هیچ نامی برای تکنیک وارد نشده است.'], 400);
        }
        $item = Technique::where('id', $request->id)->get()->first(); 
        if (!$item) {
            return response()->json(['error' => 'چنین تکنیکی وجود ندارد.'], 400);
        }
        $res = $item->update($request->all());

        if($res)
        {
            $item = Technique::where('id', $request->id)->get()->first(); 
            return response()->json(['data' => new TechniqueResource($item)], 200);
        }
        return response()->json(['error' => 'خطا در ویرایش تکنیک'], 400);
    } 
    

    public function delete(Request $request)
    {
        if (!$request->id) {
            return response()->json(['error' => 'هیچ آی دی برای تکنیک وارد نشده است.'], 400);
        }
        $item = Technique::where('id', $request->id)->get()->first(); 
        if (!$item) {
            return response()->json(['error' => 'چنین تکنیکی وجود ندارد.'], 400);
        }
        $res = $item->delete();

        if($res)
        {
            return response()->json(['data' => ['message'=>'تکنیک با موفقیت حذف گردید.']], 200);
        }
        return response()->json(['error' => 'خطا در ویرایش تکنیک'], 400);
    } 
}

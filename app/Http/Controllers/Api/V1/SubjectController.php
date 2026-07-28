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
        $items= Subject::latest()->get(); 
        if($items)   
        {
            return response()->json(['data' => SubjectResource::collection($items)], 200);
        }
        return response()->json(['error' => 'هیچ موضوعی وجود ندارد.'], 400);
    }


    public function info(Request $request)
    {
        if (!$request->id) {
            return response()->json(['error' => 'هیچ آی دی برای موضوع وارد نشده است.'], 400);
        }
        $item = Subject::where('id', $request->id)->get()->first(); 
        if($item)   
        {
            return response()->json(['data' => new SubjectResource($item)], 200);
        }
        return response()->json(['error' => 'چنین موضوعی وجود ندارد.'], 400);
        
    }
    
    
    public function update(Request $request)
    {
        if (!$request->id) {
            return response()->json(['error' => 'هیچ آی دی برای موضوع وارد نشده است.'], 400);
        }
        if (!$request->name) {
            return response()->json(['error' => 'هیچ نامی برای موضوع وارد نشده است.'], 400);
        }
        $item = Subject::where('id', $request->id)->get()->first(); 
        if (!$item) {
            return response()->json(['error' => 'چنین موضوعی وجود ندارد.'], 400);
        }
        $res = $item->update($request->all());

        if($res)
        {
            $item = Subject::where('id', $request->id)->get()->first(); 
            return response()->json(['data' => new SubjectResource($item)], 200);
        }
        return response()->json(['error' => 'خطا در ویرایش موضوع'], 400);
    } 
    

    public function delete(Request $request)
    {
        if (!$request->id) {
            return response()->json(['error' => 'هیچ آی دی برای موضوع وارد نشده است.'], 400);
        }
        $item = Subject::where('id', $request->id)->get()->first(); 
        if (!$item) {
            return response()->json(['error' => 'چنین موضوعی وجود ندارد.'], 400);
        }
        $res = $item->delete();

        if($res)
        {
            return response()->json(['data' => ['message'=>'موضوع با موفقیت حذف گردید.']], 200);
        }
        return response()->json(['error' => 'خطا در ویرایش موضوع'], 400);
    } 
}

<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\SellResource;
use App\Models\Sell;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SellController extends Controller
{
    public function info(Request $request)
    {
        if (!$request->id) {
            return response()->json(['error' => 'هیچ آی دی برای نظر وارد نشده است.'], 400);
        }
        $item = Sell::where('id', $request->id)->get()->first(); 
        if($item)   
        {
            return response()->json(['data' => new SellResource($item)], 200);
        }
        return response()->json(['error' => 'چنین فروشی وجود ندارد.'], 400);
        
    }


    public function add(Request $request)
    {
        if (!$request->project_id) {
            return response()->json(['error' => 'آی دی پروژه وارد نشده است'], 400);
        }
        if (!$request->price) {
            return response()->json(['error' => 'قیمتی برای پروژه وارد نشده است'], 400);
        }

        $item = Sell::create($request->all());

        if($item)
        {
            return response()->json(['data' => ['message' => 'فروش پروژه با موفقیت ایجاد شد']], 200);
        }
        return response()->json(['error' => 'خطا در ایجاد فروش پروژه'], 400);
        
    } 
    
    
    public function update(Request $request)
    {
        if (!$request->id) {
            return response()->json(['error' => 'هیچ آی دی برای پروژه وارد نشده است.'], 400);
        } 
        $id = $request->user()->currentAccessToken()->tokenable_id;

        $item = Sell::join('projects', 'projects.id', 'sells.project_id')
            ->join('members', 'members.id', 'projects.member_id')
            ->where('sells.id', $request->id)->where('members.id', $id)
            ->get()->first(); 
        if (!$item) {
            return response()->json(['error' => 'چنین فدوشی وجود ندارد ویا این پروژه متعلق به شما نیست.'], 400);
        }

        $res = $item->update($request->all());

        if($res)
        {
            $item = Sell::where('id', $request->id)->get()->first(); 
            return response()->json(['data' =>['message' => 'فروش با موفقیت ویرایش شد', 'data' => new SellResource($item)]], 200);
        }
        return response()->json(['error' => 'خطا در ویرایش فروش'], 400);
    } 
    

    public function delete(Request $request)
    {
        if (!$request->id) {
            return response()->json(['error' => 'هیچ آی دی برای پروژه وارد نشده است.'], 400);
        } 
        $id = $request->user()->currentAccessToken()->tokenable_id;

        $item = Sell::join('projects', 'projects.id', 'sells.project_id')
            ->join('members', 'members.id', 'projects.member_id')
            ->where('sells.id', $request->id)->where('members.id', $id)
            ->get()->first(); 
        if (!$item) {
            return response()->json(['error' => 'چنین فدوشی وجود ندارد ویا این پروژه متعلق به شما نیست.'], 400);
        }

        $res = $item->delete();

        if($res)
        {
            return response()->json(['data' => ['message'=>'فروش با موفقیت حذف گردید.']], 200);
        }
        return response()->json(['error' => 'خطا در ویرایش فروش'], 400);
    } 
}

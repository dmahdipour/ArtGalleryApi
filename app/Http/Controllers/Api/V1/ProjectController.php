<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use App\Models\Technique;
use App\Models\Style;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;


class ProjectController extends Controller
{
    public function index()
    {
        $items = Project::latest()->get(); 
        if($items)   
        {
            return response()->json(['data' => ProjectResource::collection($items)], 200);
        }
        return response()->json(['error' => 'هیچ پروژه ای وجود ندارد.'], 400);
    }


    public function info(Request $request)
    {
        if (!$request->id) {
            return response()->json(['error' => 'هیچ آی دی برای پروژه وارد نشده است.'], 400);
        }
        $item = Project::where('id', $request->id)->get()->first(); 
        if($item)   
        {
            $member = Member::where('id', $item->member_id)->get()->first();
            if ($member->signature) {
                $item['signature']=$member->signature;
            }
            return response()->json(['data' => new ProjectResource($item)], 200);
        }
        return response()->json(['error' => 'چنین پروژه ای وجود ندارد.'], 400);
        
    }


    public function add(Request $request)
    {
        if (!$request->member_id) {
            return response()->json(['error' => 'ورود آی دی کاربر اجباری است.'], 400);
        }

        $data = $request->all();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('images/projects', $imageName, 'public');
            $data['image'] = $imagePath;
        }
        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $thumbnailName = uniqid() . '.' . $thumbnail->getClientOriginalExtension();
            $thumbnailPath = $thumbnail->storeAs('images/projects/thumbnails', $thumbnailName, 'public');
            $data['thumbnail'] = $thumbnailPath;
        }
        if ($request->hasFile('signature')) {
            $signature = $request->file('signature');
            $signatureName = uniqid() . '.' . $signature->getClientOriginalExtension();
            $signaturePath = $signature->storeAs('images/projects/signatures', $signatureName, 'public');
            $data['signature'] = $signaturePath;
        }

        $item = Project::create($data);
        if($item)
        {
            return response()->json(['data' => ['message' => 'پروژه با موفقیت ایجاد شد']], 200);
        }
        return response()->json(['error' => 'خطا در ایجاد پروژه'], 400);
    } 


    public function update(Request $request)
    {
        if (!$request->id) {
            return response()->json(['error' => 'هیچ آی دی برای پروژه وارد نشده است.'], 400);
        } 
        $id = $request->user()->currentAccessToken()->tokenable_id;

        $item = Project::join('members', 'members.id', 'projects.member_id')
            ->where('projects.id', $request->id)->where('members.id', $id)
            ->get()->first(); 
        if (!$item) {
            return response()->json(['error' => 'چنین پروژه ای وجود ندارد ویا این پروژه متعلق به شما نیست.'], 400);
        }

        $data = $request->all();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('images/projects', $imageName, 'public');
            $data['image'] = $imagePath;
        }
        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $thumbnailName = uniqid() . '.' . $thumbnail->getClientOriginalExtension();
            $thumbnailPath = $thumbnail->storeAs('images/projects/thumbnails', $thumbnailName, 'public');
            $data['thumbnail'] = $thumbnailPath;
        }
        if ($request->hasFile('signature')) {
            $signature = $request->file('signature');
            $signatureName = uniqid() . '.' . $signature->getClientOriginalExtension();
            $signaturePath = $signature->storeAs('images/projects/signatures', $signatureName, 'public');
            $data['signature'] = $signaturePath;
        }
        
        $res = $item->update($data);
        if($res)
        {
            return response()->json(['data' => ['message' => 'پروژه با موفقیت ویرایش شد', 'data' => new ProjectResource($item)]], 200);
        }
        return response()->json(['error' => 'خطا در ویرایش پروژه'], 400);
    } 
    

    public function delete(Request $request)
    {
        if (!$request->id) {
            return response()->json(['error' => 'هیچ آی دی برای پروژه وارد نشده است.'], 400);
        } 
        $id = $request->user()->currentAccessToken()->tokenable_id;

        $item = Project::join('members', 'members.id', 'projects.member_id')
            ->where('projects.id', $request->id)->where('members.id', $id)
            ->get()->first(); 
        if (!$item) {
            return response()->json(['error' => 'چنین پروژه ای وجود ندارد ویا این پروژه متعلق به شما نیست.'], 400);
        }

        $res = $item->delete();

        if($res)
        {
            return response()->json(['data' => ['message'=>'پروژه با موفقیت حذف گردید.']], 200);
        }
        return response()->json(['error' => 'خطا در ویرایش پروژه'], 400);
    } 
}

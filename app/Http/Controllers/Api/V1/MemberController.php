<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\MemberResource;
use App\Models\Member;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Mail\ConfirmCodeMail;
use App\Mail\ChangePasswordConfirmCodeMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class MemberController extends Controller
{
    public function index()
    {
        $members= Member::get()->latest(); 
        if($members)   
        {
            return response()->json(['data' => ['data' => MemberResource::collection($members)]], 200);
        }
        return response()->json(['error' => 'هیچ کاربری وجود ندارد.'], 400);
    }


    public function info(Request $request)
    {
        $id = $request->user()->currentAccessToken()->tokenable_id;
        $member = Member::where('id', $id)->get()->first(); 
        if($member)   
        {
            return response()->json(['data' => ['data' => new MemberResource($member)]], 200);
        }
        return response()->json(['error' => 'چنین کاربری وجود ندارد.'], 400);
        
    }



    public function setProfile(Request $request)
    {
        if (!$request->email && !$request->user_name && !$request->hasFile('avatar')) {
            return response()->json(['error' => 'هیچ اطلاعاتی برای آپدیت وارد نشده است.'], 400);
        }

        $id = $request->user()->currentAccessToken()->tokenable_id;
        $is_exist=Member::where('id', $id)->first();
        if (!$is_exist) {
            return response()->json(['error' => 'کاربری با این مشخصات یافت نشد.'], 400);
        }
        if ($request->email) {
            $is_exist->update(['email' => $request->email]);
        }
        if ($request->user_name) {
            $is_exist_username = MemberProfile::where('member_id', $id)->get()->first();
            $is_exist_username->update(['user_name' => $request->user_name]);
        }
        
        if ($request->hasFile('avatar')) {
            $image = $request->file('avatar');
            $imageName = $id . '.' . $image->getClientOriginalExtension();
            $url = $image->storeAs('avatars', $imageName, 'public');
            $is_exist_username = MemberProfile::where('member_id', $id)->get()->first();
            $is_exist_username->update(['avatar' => $url]);
        }
        $is_exist=Member::where('id', $id)->first();
        return response()->json(['data' => new MemberResource($is_exist)], 200);
    }
}

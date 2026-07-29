<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\MemberResource;
use App\Models\Member;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Mail\VerificationCodeMail;
use App\Mail\ChangePasswordVerificationCodeMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class MemberController extends Controller
{
    public function index()
    {
        $members= Member::latest()->get(); 
        if($members)   
        {
            return response()->json(['data' => MemberResource::collection($members)], 200);
        }
        return response()->json(['error' => 'هیچ کاربری وجود ندارد.'], 400);
    }


    public function info(Request $request)
    {
        $id = $request->user()->currentAccessToken()->tokenable_id;
        $member = Member::where('id', $id)->get()->first(); 
        if($member)   
        {
            return response()->json(['data' => new MemberResource($member)], 200);
        }
        return response()->json(['error' => 'چنین کاربری وجود ندارد.'], 400);
        
    }


    public function signUp(Request $request)
    {
        if(!$request->email){
            return response()->json(['error' => 'ایمیل وارد نشده است.'], 400);
        }
        if(!$request->user_name){
            return response()->json(['error' => 'نام کاربری وارد نشده است.'], 400);
        }

        $is_exist = Member::where('email', $request->email)->first();
        if ($is_exist) {
            return response()->json(['error' => 'با این ایمیل ثبت نام انجام شده است. در صورت نیاز از گزینه فراموشی رمز استفاده نمایید.'], 400);
        }

        $is_exist_username = Member::where('user_name', $request->user_name)->first();
        if ($is_exist_username) {
            return response()->json(['error' => 'این نام کاربری قبلا انتخاب شده است. لطفا نام دیگری را امتحان کنید'], 400);
        }

        if(!$request->password){
            return response()->json(['error' => 'رمز عبور وارد نشده است.'], 400);
        }

        $member = Member::create([
            'email' => $request->email,
            'user_name' => $request->user_name,
            'password' => Hash::make($request->password),
        ]);

        $verification_code = Member::where('email', $request->email)->first()->verification_code;    
        if ($verification_code) {              
            $sent_email = $this->send_verification_email($request->email, $verification_code);
            if($sent_email){
                return response()->json(['data' => ['message' => 'یک ایمیل تایید برای شما ارسال گردید.']], 200);
            }
            else{
                return response()->json(['error' => 'خطا در ارسال ایمیل تایید رخ داده است.'], 400);
            }
        }
        return response()->json(['error' => 'خطا در ثبت کاربر رخ داده است.'], 400);
    }
    public function send_verification_email($email, $verification_code)
    {
        try {
            Mail::to($email)->send(new VerificationCodeMail($verification_code));
        } catch (\Throwable $e) {
            return false;
        }
        return true;
    }


    public function resend_verificationEmail(Request $request)
    {
        if(!$request->email){
            return response()->json(['error' => 'ایمیل وارد نشده است.'], 400);
        }
        $verification_code = Member::where('email', $request->email)->first()->verification_code;    
        if ($verification_code) {              
            $sent_email = $this->send_verification_email($request->email, $verification_code);
            if($sent_email){
                return response()->json(['data' => ['message' => 'یک ایمیل تایید برای شما ارسال گردید.']], 200);
            }
            else{
                return response()->json(['error' => 'خطا در ارسال ایمیل تایید رخ داده است.'], 400);
            }
        }
    }


    public function verifyEmail(Request $request)
    {
        if(!$request->email){
            return response()->json(['error' => 'ایمیل وارد نشده است.'], 400);
        }
        if(!$request->verification_code){
            return response()->json(['error' => 'کد تایید ایمیل وارد نشده است.'], 400);
        }
        $is_exist = Member::where('email', $request->email)->first();
        if ($is_exist && $is_exist->verification_code == $request->verification_code) {
            $is_exist->update(['is_email_verified' => true]);
            return response()->json(['data' => ['message' => 'ایمیل شما با موفقیت تایید شد.']], 200);
        }
        else{
            return response()->json(['error' => 'کد تایید و یا ایمیل درست وارد نشده است.'], 400);
        }
    }


    public function forgetPassword(Request $request)
    {
        if(!$request->email){
            return response()->json(['error' => 'ایمیل وارد نشده است.'], 400);
        }
        $is_exist = Member::where('email', $request->email)->first();
        $change_password_verification_code = random_int(12345, 98765);
        $is_exist->update(['verification_code'=> $change_password_verification_code]);
        
        $sent_email = $this->send_change_password_verification_email($request->email, $change_password_verification_code);
        if($sent_email){
            return response()->json(['data' => ['message' => 'یک ایمیل تایید برای شما ارسال گردید.']], 200);
        }
        else{
            return response()->json(['error' => 'خطا در ارسال ایمیل تایید رخ داده است.'], 400);
        }
    }
    public function send_change_password_verification_email($email, $change_password_verification_code)
    {
        try {
            Mail::to($email)->send(new ChangePasswordVerificationCodeMail($change_password_verification_code));
        } catch (\Throwable $e) {
            return false;
        }
        return true;
    }


    public function changePassword(Request $request)
    {
        if(!$request->email){
            return response()->json(['error' => 'ایمیل وارد نشده است.'], 400);
        }
        if(!$request->password){
            return response()->json(['error' => 'رمز عبور وارد نشده است.'], 400);
        }
        if(!$request->verification_code){
            return response()->json(['error' => 'کد تایید وارد نشده است.'], 400);
        }
        $is_exist = Member::where('email', $request->email)->first();
        if ($is_exist->verification_code != $request->verification_code) {
            return response()->json(['error' => 'کد تایید اشتباه وارد شده است.'], 400);
        }
        $is_exist->update(['password' => Hash::make($request->password), 'verification_code' => 0]);
        return response()->json(['data' => ['message' => 'رمز عبور با موفقیت تغییر یافت']], 200);
    }


    public function login(Request $request)
    {
        if(!$request->password){
            return response()->json(['error' => 'رمز عبور وارد نشده است.'], 400);
        }
        if(!$request->email && !$request->user_name){
            return response()->json(['error' => 'ایمیل ویا نام کاربری وارد نشده است.'], 400);
        }
        else{
            $is_exist = Member::where('email', $request->email)->orwhere('user_name', $request->user_name)->first();
            if (!$is_exist) {
                return response()->json(['error' => 'کاربری با این مشخصات یافت نشد.'], 400);
            }
            if(!$is_exist->status){
                return response()->json(['error' => 'کاربر غیرفعال شده است. با مدیر سیستم تماس بگیرید.'], 400);
            }
            if (!$is_exist->is_email_verified){
                return response()->json(['error' => 'ایمیل کاربر هنوز تایید نشده است.'], 400);
            }
            if(Hash::check($request->password, $is_exist->password)){
                $is_exist->tokens()->where('tokenable_id', $is_exist->id)->delete();
                $token = $is_exist->createToken('app-token')->plainTextToken;
                return response()->json(['token' => $token, 'data' => new MemberResource($is_exist)], 200);
            }
        }
    }


    public function setProfile(Request $request)
    {
        if (!$request->email && !$request->user_name) {
            return response()->json(['error' => 'نام کاربری و ایمیل خالی است.'], 400);
        }

        $id = $request->user()->currentAccessToken()->tokenable_id;
        $is_exist=Member::where('id', $id)->first();
        if (!$is_exist) {
            return response()->json(['error' => 'کاربری با این مشخصات یافت نشد.'], 400);
        }
        
        $is_exist->update($request->all());
        $is_exist = Member::where('id', $id)->get()->first();
        
        if ($request->hasFile('avatar')) {
            $image = $request->file('avatar');
            $imageName = $id . '.' . $image->getClientOriginalExtension();
            $url = $image->storeAs('avatars', $imageName, 'public');
            $is_exist->update(['avatar' => $url]);
        }

        if ($request->hasFile('signature')) {
            $signature = $request->file('signature');
            $signatureName = $id . '.' . $signature->getClientOriginalExtension();
            $signatureUrl = $signature->storeAs('images/members/signatures', $signatureName, 'public');
            $is_exist->update(['avatar' => $url]);
        }

        $is_exist=Member::where('id', $id)->first();
        return response()->json(['data' => new MemberResource($is_exist)], 200);
    }


    public function deactiveUser(Request $request)
    {
        $id= $request->id;
        if(!$request->id){
            return response()->json(['error' => 'ای دی کاربر وارد نشده است.'], 400);
        }
        $is_exist=Member::where('id', $id)->first();
        
        if(!$is_exist){
            return response()->json(['error' => 'چنین کاربری وجود ندارد.'], 400);
        }
        $res = $is_exist->update([
            'status' => 0,
        ]);

        if($res)
        {
            return response()->json(['data' => ['message' => 'وضعیت کاربر به غیر فعال تغییر کرد']], 200);
        }
        return response()->json(['error' => 'خطا در غیرفعالسازی کاربری'], 400);
    }
}

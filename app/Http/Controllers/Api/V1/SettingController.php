<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\SettingResource;
use App\Models\Setting;
use Illuminate\Http\Response;

class SettingController extends Controller
{
    public function getSettings(Request $request)
    {
        if(!$request->name){
            return response()->json(['error' => 'نام تنظیمات وارد نشده است.'], 400);
        }
        $setting=Setting::where('name','=', $request->name)->first();
        return response()->json(['data' => new SettingResource($setting)], 200);
    }
}

<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\SellResource;
use App\Models\Sell;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SellController extends Controller
{
    public function info(Request $request)
    {
        $item = Sell::where('id', $request->id)->get()->first(); 
        if($item)   
        {
            return response()->json(['data' => ['data' => new SellResource($item)]], 200);
        }
        return response()->json(['error' => 'چنین پروژه ای وجود ندارد.'], 400);
        
    }
}

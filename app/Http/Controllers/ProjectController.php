<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Project;
use App\Models\Member;
use App\Http\Resources\ProjectResource;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;


class ProjectController extends Controller
{
    public function index()
    {
        $items = Project::latest()->get();
        return view('ui.project.index', compact(['items']));
    }


    public function info(Request $request)
    {
        if (!$request->uuid) {
            return redirect()->route('projectIndex')->with('error', 'هیچ آی دی برای پروژه وارد نشده است.');
        }
        $item = Project::where('uuid', $request->uuid)->get()->first();
        if($item)   
        {
            $member = Member::where('id', $item->member_id)->get()->first();
            if ($member->signature) {
                $item['signature']=$member->signature;
            }
            // return new ProjectResource($item);
            return view('ui.project.info', compact(['item']));
        }
        return redirect()->route('projectIndex')->with('error', 'چنین پروژه ای وجود ندارد.');        
    }
}

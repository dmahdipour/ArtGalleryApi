<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Page;
use App\Models\Project;
use App\Models\Member;
use App\Models\Technique;
use App\Models\Style;
use App\Models\Subject;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;


class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $projects = Project::query()
            ->with([
                'member',
                'technique',
                'style',
                'subject',
            ])
            ->when(
                $request->filled('member'),
                fn ($query) =>
                    $query->where('member_id', $request->member)
            )
            ->when(
                $request->filled('technique'),
                fn ($query) =>
                    $query->where('technique_id', $request->technique)
            )
            ->when(
                $request->filled('style'),
                fn ($query) =>
                    $query->where('style_id', $request->style)
            )
            ->when(
                $request->filled('subject'),
                fn ($query) =>
                    $query->where('subject_id', $request->subject)
            )
            ->when(
                $request->get('sort') === 'oldest',
                fn ($query) =>
                    $query->oldest()
            )
            ->when(
                $request->get('sort') !== 'oldest',
                fn ($query) =>
                    $query->latest()
            )
            ->paginate(20)
            ->withQueryString();

        $techniques = Technique::query()
            ->orderBy('name_fa')
            ->get();

        $styles = Style::query()
            ->orderBy('name_fa')
            ->get();

        $subjects = Subject::query()
            ->orderBy('name_fa')
            ->get();

        return view('ui.project.index', compact(
            'projects',
            'techniques',
            'styles',
            'subjects'
        ));
    }


    public function info(Request $request)
    {
        if (!$request->uuid) {
            return redirect()->route('projectIndex')->with('error', 'هیچ آی دی برای پروژه وارد نشده است.');
        }
        $item = Project::where('uuid', $request->uuid)->first();
        if($item)   
        {
            $member = Member::find($item->member_id);
            if ($member->signature) {
                $item->signature = $member->signature;
            }
            
            return view('ui.project.info', ['item'=>$item]);
        }
        return redirect()->route('projectIndex')->with('error', 'چنین پروژه ای وجود ندارد.');        
    }

    public function qr(Request $request)
    {
        if (!$request->uuid) {
            return redirect()->route('projectIndex')->with('error', 'هیچ آی دی برای پروژه وارد نشده است.');
        }
        $item = Project::where('uuid', $request->uuid)->first();
        if($item)   
        {
            return view('ui.project.qr', ['item'=>$item]);
        }
        return redirect()->route('projectIndex')->with('error', 'چنین پروژه ای وجود ندارد.');        
    }

    public function tag(Request $request)
    {
        if (!$request->tag) {
            return redirect()->route('projectIndex')->with('error', 'هیچ برچسبی برای پروژه وارد نشده است.');
        }
        if (!$request->id) {
            return redirect()->route('projectIndex')->with('error', 'هیچ ای دی برای تگ وارد نشده است.');
        }
        if (!in_array($request->tag, ['technique', 'style', 'subject'])) {
            return redirect()->route('projectIndex')->with('error', 'نوع برچسب نامعتبر است.');
        }

        $column = match ($request->tag) {
            'technique' => 'technique_id',
            'style'     => 'style_id',
            'subject'   => 'subject_id',
        };

        $projects = Project::query()
            ->with([
                'technique',
                'style',
                'subject',
            ])
            ->where($column, $request->id)
            ->when(
                $request->get('tag') === 'technique',
                fn ($query) => $query->where('technique_id', $request->id)
            )
            ->when(
                $request->get('tag') === 'style',
                fn ($query) => $query->where('style_id', $request->id)
            )
            ->when(
                $request->get('tag') === 'subject',
                fn ($query) => $query->where('subject_id', $request->id)
            )
            ->when(
                $request->get('sort') === 'oldest',
                fn ($query) =>
                    $query->oldest()
            )
            ->when(
                $request->get('sort') !== 'oldest',
                fn ($query) =>
                    $query->latest()
            )
            ->paginate(12)
            ->withQueryString();

        $techniques = Technique::query()
            ->orderBy('name_fa')
            ->get();

        $styles = Style::query()
            ->orderBy('name_fa')
            ->get();

        $subjects = Subject::query()
            ->orderBy('name_fa')
            ->get();
        
        $tag = $request->tag;
        $tagName = match ($tag) {
            'technique' => 'تکنیک',
            'style'     => 'سبک',
            'subject'   => 'موضوع',
        };
        $tagValue = DB::table($tag.'s')
            ->where('id', $request->id)
            ->value('name_fa');
        return view('ui.project.tag', compact(
            'tagName',
            'tagValue',
            'projects',
            'techniques',
            'styles',
            'subjects'
        ));      
    }
}

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


class HomeController extends Controller
{
    public function index(Request $request)
    {
        $projects = Project::query()
            ->with([
                'technique',
                'style',
                'subject',
            ])
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
            ->take(12)->get();

        $techniques = Technique::query()
            ->orderBy('name_fa')
            ->get();

        $styles = Style::query()
            ->orderBy('name_fa')
            ->get();

        $subjects = Subject::query()
            ->orderBy('name_fa')
            ->get();

        $sliders = Page::where('name', 'like', 'slider%')
            ->orderBy('id')
            ->get();
        
        $allProjects = Project::count();
        $allmembers = Member::count();

        return view('ui.index', compact(
            'allProjects',
            'allmembers',
            'projects',
            'sliders',
            'techniques',
            'styles',
            'subjects'
        ));
    }
}

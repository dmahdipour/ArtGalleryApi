<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Page;
use App\Models\User;
use App\Models\Project;
use App\Models\Member;
use App\Models\Setting;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;


class MemberController extends Controller
{
    public function index(Request $request)
    {
        $users = User::query()
            ->where('users.is_active', 1)->whereNotNull('users.email_verified_at')
            ->with([
                'member' => function ($query) {
                    $query->withCount([
                        'projects' => function ($query) {
                            $query->where('status', 1);
                        },
                    ]);
                },
            ])
            ->orderByDesc(
                Member::selectRaw('COUNT(projects.id)')
                    ->join('projects', 'projects.member_id', '=', 'members.id')
                    ->whereColumn('members.user_id', 'users.id')
                    ->where('projects.status', 1)
            )
            ->paginate(20)
            ->withQueryString();

        
        $site_title = Setting::where('name', 'site-title')->first()->value ?? 'سمفونی رنگ';
        $site_describe = Setting::where('name', 'site-describe')->first()->value ?? 'گالری تابلوهای ایران و جهان';
        $title = 'هنرمندان '.$site_title.' ('.$site_describe.')';
        return view('ui.member.index', compact(
            'users',
            'title'
        ));
    }
}

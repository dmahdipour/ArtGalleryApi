<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Page;
use App\Models\User;
use App\Models\Project;
use App\Models\Member;
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

        return view('ui.member.index', compact(
            'users',
        ));
    }
}

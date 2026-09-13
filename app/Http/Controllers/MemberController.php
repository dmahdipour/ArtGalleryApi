<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Page;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;


class MemberController extends Controller
{
    public function index(Request $request)
    {
        $users = User::query()
            ->where('is_active', 1)
            ->with('member')
            ->withCount([
                'member as projects_count' => function ($query) {
                    $query->withCount('projects');
                },
            ])
            ->orderByDesc('projects_count')
            ->paginate(20)
            ->withQueryString();

        return view('ui.member.index', compact(
            'users',
        ));
    }
}

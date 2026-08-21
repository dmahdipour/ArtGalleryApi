<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Page;
use App\Models\Member;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;


class MemberController extends Controller
{
    public function index(Request $request)
    {
        $members = Member::query()
            ->paginate(20)
            ->withQueryString();

        return view('ui.member.index', compact(
            'members',
        ));
    }
}

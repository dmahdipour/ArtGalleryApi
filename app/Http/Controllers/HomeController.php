<?php

namespace App\Http\Controllers;
use DB;
use App\Models\Page;
use App\Models\Survey;
use App\Models\Answer;
use App\Models\Media;
use App\Models\Reward;
use Illuminate\Support\Facades\Http;

use App\Mail\ConfirmCodeMail;
use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;


class HomeController extends Controller
{
    public function index()
    {
        return 'Art Gallery';
    }
}

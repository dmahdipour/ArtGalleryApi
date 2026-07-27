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
        return 'Human Cipher';
    }



    public function applySurvey(Request $request)
    {
        $id=$request->id;
        $survey=Survey::where(['id'=>$id])->first();
        $answerCount=Answer::where(['survey_id'=>$id])->count();
        $mostPopularAnswer=Answer::where(['survey_id'=>$id])
                   ->select('media_id', DB::raw('COUNT(*) as count'))
                   ->groupBy('media_id')
                   ->orderBy('count', 'desc')
                   ->first();
        $popularMedia=Media::where(['id'=>$mostPopularAnswer->media_id])->first();
        $meessage="";
        return view('applySurvey', compact('survey', 'answerCount', 'mostPopularAnswer', 'popularMedia', 'meessage'));
    }
    public function doApplySurvey(Request $request)
    {
        $id=$request->id;
        $survey=Survey::where(['id'=>$id])->first();
        $answerCount=Answer::where(['survey_id'=>$id])->count();
        $mostPopularAnswer=Answer::select('media_id', DB::raw('COUNT(*) as count'))
                   ->groupBy('media_id')
                   ->orderBy('count', 'desc')
                   ->first();
        $popularMedia=Media::where(['id'=>$mostPopularAnswer->media_id])->first();
        //return $popularMedia;
        $winners=Answer::where(['survey_id'=>$id, 'media_id'=>$popularMedia->id])->get();

        foreach($winners as $ans)
        {
            Reward::create(['name'=>$survey->question.'| Reward', 'member_id'=>$ans->member_id, 'score'=>5]);
        }
        $meessage="اعمال امتیازات موفقیت آمیز بود";
        return view('applySurvey', compact('survey', 'answerCount', 'mostPopularAnswer', 'popularMedia', 'meessage'));
    }

    //----------------------------
    public function bot(Request $request)
    {

        $update = $request->all();
        $token = "7523694261:AAEsSk73T3c7-3ScpShdaqw4FNEzResemkw";

        if (isset($update['message']['text']) && $update['message']['text'] === '/start') {
            $this->start_menu($token, $update);
            return response()->json(['status' => 'success']);
        }
        else if (isset($update['message']['text']) && $update['message']['text'] === '/id') {
            $this->send_chat_id($token, $update);
            return response()->json(['status' => 'success']);
        }
        else
        {
            $nextStep = Cache::get("telegram_user_{$userId}_next_step");
            $chatId = $update['callback_query']['message']['chat']['id'];

            $responseText ="OOOO ".$nextStep;
            $inlineKeyboard = [
            ];
            $this->send_message($token, $chatId, $responseText, $inlineKeyboard);
        }
        if (isset($update['callback_query'])) {
            $callbackData = $update['callback_query']['data'];
            if ($callbackData === 'profile')
            {
                $this->profile_menu($token,$update );
            }
            elseif($callbackData === 'Developer')
            {
                $this->developer_menu($token,$update );
            }
            elseif($callbackData === 'Producer')
            {
                $this->producer_menu($token,$update );
            }
            elseif($callbackData === 'start_menu')
            {
                $this->profile_menu($token,$update );
            }
            elseif($callbackData === 'beDeveloper')
            {
                $this->be_developer_menu($token,$update );
            }
            elseif ($callbackData === 'settings') {
                $chatId = $update['callback_query']['message']['chat']['id'];
                Http::post("https://api.telegram.org/bot{$token}/sendMessage", [
                    'chat_id' => $chatId,
                    'text' => '⚙️ تنظیمات ربات: ...',
                ]);
            }

            // پاسخ به تلگرام (برای حذف حالت "در حال بارگذاری" روی دکمه)
            Http::post("https://api.telegram.org/bot{$token}/answerCallbackQuery", [
                'callback_query_id' => $update['callback_query']['id'],
            ]);
        }

        return response()->json(['status' => 'ignored']);
    }

    public function start_menu( $token,$update )
    {
        $chatId = $update['message']['chat']['id'];
        $p=Page::where(['slug'=>'profile'])->first();
        $responseText ="d";
        if($p!=null)
        {
            $responseText =$p->description;
        }

        $inlineKeyboard = [
            [
                ['text' => '👨‍💻 Developer', 'callback_data' => 'Developer'],
                ['text' => '🤵‍♂️ Producer', 'callback_data' => 'Producer'],
            ],
            [
                ['text' => '📩 contact us', 'callback_data' => 'Contact'],
            ],
        ];
        $this->send_message($token, $chatId, $responseText, $inlineKeyboard);

    }

    public function profile_menu($token,$update )
    {
        $chatId = $update['callback_query']['message']['chat']['id'];
        $p=Page::where(['slug'=>'profile'])->first();
        $responseText ="d";
        if($p!=null)
        {
            $responseText =$p->description;
        }

        $inlineKeyboard = [
            [
                ['text' => '👨‍💻 Developer', 'callback_data' => 'Developer'],
                ['text' => '🤵‍♂️ Producer', 'callback_data' => 'Producer'],
            ],
            [
                ['text' => '📩 contact us', 'callback_data' => 'Contact'],
            ],

        ];
        $this->send_message($token, $chatId, $responseText, $inlineKeyboard);
    }
    public function developer_menu($token,$update )
    {
        $chatId = $update['callback_query']['message']['chat']['id'];
        $p=Page::where(['slug'=>'developer'])->first();
        $responseText ="d";
        if($p!=null)
        {
            $responseText =$p->description;
        }

        $inlineKeyboard = [
            [
                ['text' => 'Yes! Lets go', 'callback_data' => 'beDeveloper'],
                ['text' => 'No.', 'callback_data' => 'start_menu'],
            ],
        ];
        $this->send_message($token, $chatId, $responseText, $inlineKeyboard);
    }

    public function producer_menu($token,$update )
    {
        $chatId = $update['callback_query']['message']['chat']['id'];
        $p=Page::where(['slug'=>'producer'])->first();
        $responseText ="d";
        if($p!=null)
        {
            $responseText =$p->description;
        }

        $inlineKeyboard = [
            [
                ['text' => 'Yes! Lets go', 'callback_data' => 'beProducer'],
                ['text' => 'No.', 'callback_data' => 'start_menu'],
            ],
        ];
        $this->send_message($token, $chatId, $responseText, $inlineKeyboard);
    }

    public function be_developer_menu($token,$update )
    {
        $chatId = $update['callback_query']['message']['chat']['id'];
        $responseText ="Please tell us about yourself and your experiences(up to 100 word).";
        $inlineKeyboard = [
        ];
        $this->send_message($token, $chatId, $responseText, $inlineKeyboard);
    }

    public function send_chat_id($token,$update )
    {
        $chatId = $update['callback_query']['message']['chat']['id'];
        $responseText ="Your Chat Id:".$chatId;
        $inlineKeyboard = [
            [
                ['text' => 'Menu', 'callback_data' => 'start_menu'],
            ],
        ];
        $this->send_message($token, $chatId, $responseText, $inlineKeyboard);
    }
    public function send_request($token,$update )
    {
        $chatId = $update['callback_query']['message']['chat']['id'];
        $responseText ="Your Chat Id:".$update['callback_query']['message']['chat']['id'];
        $inlineKeyboard = [
            [
                ['text' => 'Menu', 'callback_data' => 'start_menu'],
            ],
        ];
        $this->send_message($token, $chatId, $responseText, $inlineKeyboard);
    }




    public function send_message($token, $chatId, $responseText, $inlineKeyboard)
    {
            $response = Http::post("https://api.telegram.org/bot{$token}/sendMessage", [
                'chat_id' => $chatId,
                'text' => $responseText,
                'parse_mode' => 'HTML', // فعال کردن قالب‌بندی HTML
                'reply_markup' => json_encode([
                    'inline_keyboard' => $inlineKeyboard,
                ]),
            ]);
    }

}

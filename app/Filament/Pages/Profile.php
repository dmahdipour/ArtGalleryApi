<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\Member;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Support\Facades\Auth;
use Filament\Support\Icons\Heroicon;
use BackedEnum;
use UnitEnum;
use Filament\Schemas\Schema; 

class Profile extends Page implements HasForms
{
    use InteractsWithForms;

    protected string $view = 'filament.pages.profile';
    
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUserCircle;
    protected static string|UnitEnum|null $navigationGroup = 'کاربران';
    protected static ?string $navigationLabel = 'پروفایل';
    protected static ?string $title = 'پروفایل';
    protected static ?int $navigationSort = 32;

    public ?array $data = [];

    public function mount(): void
    {
        $user = Auth::user();
        $member = Member::where('user_id', $user->id)->first();
        
        $this->form->fill([
            'name' => $user->name,
            'email' => $user->email,
            'avatar' => $user->avatar,

            'member_type_id' => $member->member_type_id,
            'name_fa' => $member->name_fa,
            'name_en' => $member->name_en,
            'birthday' => $member->birthday,
            'place' => $member->place,
            'major' => $member->major,
            'university' => $member->university,
            'activities' => $member->activities,
            'phone' => $member->phone,
            'instagram' => $member->instagram,
            'linkedin' => $member->linkedin,
            'website' => $member->website,
            'about' => $member->about,
            'signature' => $member->signature,
        ]);
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                TextInput::make('name')
                    ->label('نام')
                    ->required()
                    ->maxLength(255),
                    
                TextInput::make('email')
                    ->label('ایمیل')
                    ->email()
                    ->required()
                    ->maxLength(255),
                    // ->unique('users', 'email', ignoreRecord: true),
                    
                FileUpload::make('avatar')
                    ->columnSpan(2)
                    ->label('آواتار')
                    ->image()
                    ->disk('public')
                    ->directory('images/avatars')
                    ->nullable()
                    ->multiple(false)
                    ->maxFiles(1)
                    ->afterStateHydrated(function ($state, callable $set) {
                        // وقتی که state از دیتابیس می‌آید
                        if (is_string($state)) {
                            $set('avatar', $state);
                        }
                    }),

                /////////
                Hidden::make('member_type_id')
                    ->required(),
                TextInput::make('name_fa')
                    ->label('نام و نام خانوادگی'),
                TextInput::make('name_en')
                    ->label('نام و نام خانوادگی به انگلیسی'),
                DatePicker::make('birthday')
                    ->label('تاریخ تولد')
                    ->jalali()->displayFormat('Y/m/d'),
                TextInput::make('place')
                    ->label('محل تولد'),
                TextInput::make('major')
                    ->label('رشته تحصیلی'),
                TextInput::make('university')
                    ->label('دانشگاه'),
                TextInput::make('activities')
                    ->label('فعالیت ها'),
                TextInput::make('phone')
                    ->label('شماره تماس')
                    ->tel(),
                TextInput::make('instagram'),
                TextInput::make('linkedin'),
                TextInput::make('website')
                    ->url(),
                Textarea::make('about')
                    ->label('در مورد هنرمند')
                    ->columnSpanFull(),
                FileUpload::make('signature')
                    ->label('امضای کاری')
                    ->image()
                    ->disk('public')
                    ->image()
                    ->disk('public')
                    ->directory('images/signatures')
                    ->nullable()
                    ->multiple(false)
                    ->maxFiles(1)
                    ->afterStateHydrated(function ($state, callable $set) {
                        // وقتی که state از دیتابیس می‌آید
                        if (is_string($state)) {
                            $set('signature', $state);
                        }
                    }),
            ])
            ->statePath('data');
    }

    public function submit(): void
    {
        $data = $this->form->getState();
        $user = Auth::user();
        // بروزرسانی اطلاعات
        $user->name = $data['name'];
        $user->email = $data['email'];
        
        if (isset($data['avatar'])) {
            if (is_array($data['avatar']) && count($data['avatar']) > 0) {
                $user->avatar = $data['avatar'][0];
            } elseif (is_string($data['avatar'])) {
                $user->avatar = $data['avatar'];
            }
        }
        $user->save();
        session()->flash('message', 'پروفایل کاربری شما با موفقیت به‌روزرسانی شد.');




        $member = Member::where('user_id', $user->id)->first();
        $member->member_type_id = $data['member_type_id'];
        $member->name_fa = $data['name_fa'];
        $member->name_en = $data['name_en'];
        $member->birthday = $data['birthday'];
        $member->place = $data['place'];
        $member->major = $data['major'];
        $member->university = $data['university'];
        $member->activities = $data['activities'];
        $member->phone = $data['phone'];
        $member->instagram = $data['instagram'];
        $member->linkedin = $data['linkedin'];
        $member->website = $data['website'];
        $member->about = $data['about'];
        // ✅ بروزرسانی آواتار - اصلاح شده
        if (isset($data['signature'])) {
            if (is_array($data['signature']) && count($data['signature']) > 0) {
                $user->signature = $data['signature'][0];
            } elseif (is_string($data['signature'])) {
                $user->signature = $data['signature'];
            }
        }
        $member->save();
        session()->flash('message', 'پروفایل عضویت شما با موفقیت به‌روزرسانی شد.');
        $this->redirect('/dmy/profile');
    }

    protected function getFormActions(): array
    {
        return [
            \Filament\Actions\Action::make('submit')
                ->label('ذخیره تغییرات')
                ->submit('submit')
                ->color('primary'),
        ];
    }
}
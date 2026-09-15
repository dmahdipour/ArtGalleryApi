<?php

namespace App\Filament\Widgets;

use App\Models\Message;
use App\Models\MessageRead;
use Filament\Widgets\Widget;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;

class UserMessages extends Widget
{
    use HasWidgetShield;

    protected string $view = 'filament.widgets.user-messages';
    protected int|string|array $columnSpan = 'full';
    public Collection $messages;
    

    public function mount(): void
    {
        $this->loadMessages();
    }

    public function loadMessages(): void
    {
        $user = Auth::user();

        if (!$user) {
            $this->messages = new Collection();

            return;
        }

        $this->messages = Message::query()
            ->where('is_active', true)

            ->where(function ($query) {
                $query
                    ->whereNull('starts_at')
                    ->orWhere('starts_at', '<=', now());
            })

            ->where(function ($query) {
                $query
                    ->whereNull('expires_at')
                    ->orWhere('expires_at', '>=', now());
            })

            ->whereDoesntHave('reads', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })

            ->latest()
            ->get();
    }

    public function markAsRead(int $messageId): void
    {
        $user = Auth::user();

        if (!$user) {
            return;
        }

        $message = Message::query()
            ->whereKey($messageId)
            ->where('is_active', true)
            ->where(function ($query) {
                $query
                    ->whereNull('starts_at')
                    ->orWhere('starts_at', '<=', now());
            })
            ->where(function ($query) {
                $query
                    ->whereNull('expires_at')
                    ->orWhere('expires_at', '>=', now());
            })
            ->first();

        if (!$message) {
            return;
        }

        MessageRead::query()->updateOrCreate(
            [
                'message_id' => $message->id,
                'user_id' => $user->id,
            ],
            [
                'read_at' => now(),
            ]
        );

        $this->loadMessages();
    }
}
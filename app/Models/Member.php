<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Laravel\Sanctum\HasApiTokens;

class Member extends Model
{
    use LogsActivity, HasApiTokens;

    protected $fillable= [
        'name',
        'user_name',
        'birthday',
        'place',
        'major',
        'university',
        'activities',
        'email',
        'phone',
        'instagram',
        'linkedin',
        'website',
        'avatar',
        'status'
    ];

     

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'name',
                'user_name',
                'birthday',
                'place',
                'major',
                'university',
                'activities',
                'email',
                'phone',
                'instagram',
                'linkedin',
                'website',
                'avatar',
                'status'
            ])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}

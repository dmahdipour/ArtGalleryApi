<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
        'status',
        'about',
        'verification_code',
    ];

    
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($model) {
            if (empty($model->verification_code)) {
                $model->verification_code = random_int(123456, 987654);
            }
        });
    }


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
                'status',
                'about',
            ])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}

<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Laravel\Sanctum\HasApiTokens;

class Member extends Model
{
    use LogsActivity, HasApiTokens;

    protected $fillable= [
        'member_type_id',
        'name_fa',
        'name_en',
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
        'signature',
        'verification_code',
    ];


    public function memberType():BelongsTo
    {
        return $this->belongsTo(MemberType::class);
    }


    public function projects(): HasMany
    {
        return $this->hasMany(Project::class, 'member_id');
    }
    
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
                'member_type_id',
                'name_fa',
                'name_en',
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
                'signature',
            ])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}

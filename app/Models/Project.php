<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
class Project extends Model
{
    use LogsActivity;

    protected $fillable=[
        'member_id',
        'name_fa',
        'name_en',
        'technique_id',
        'image',
        'thumbnail',
        'height',
        'width',
        'year',
        'subject_id',
        'style_id',
        'artist_description',
        'description',
        'about',
        'signature',
        'theme',
    ];



    public function member():BelongsTo
    {
        return $this->belongsTo(Member::class);
    }

    public function technique():BelongsTo
    {
        return $this->belongsTo(Technique::class);
    }

    public function subject():BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    public function style():BelongsTo
    {
        return $this->belongsTo(Style::class);
    }


    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['member_id',
                'name_fa',
                'name_en',
                'technique_id',
                'image',
                'thumbnail',
                'height',
                'width',
                'year',
                'subject_id',
                'style_id',
                'member_description',
                'description',
                'about',
                'signature',
                'theme'
            ])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}
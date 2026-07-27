<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
class Page extends Model
{
    use LogsActivity;

    protected $fillable=['name', 'slug', 'thumbnail', 'description', 'text', 'status'];

    protected $appends = [
        'visit_count',
    ];

    public function getVisitCountAttribute()
    {
        //return User::where('id',1)->first()->name;
        return '0';
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'slug', 'thumbnail', 'description', 'text', 'status'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}

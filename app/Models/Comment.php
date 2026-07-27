<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Comment extends Model
{
    use LogsActivity;

    protected $fillable=['name',  'contact', 'sender_name', 'content', 'is_published', 'is_read'];


    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name',  'contact', 'sender_name', 'content', 'is_published', 'is_read'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}

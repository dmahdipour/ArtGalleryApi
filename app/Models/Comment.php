<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Comment extends Model
{
    use LogsActivity;

    protected $fillable=['project_id', 'name', 'contact', 'sender_name', 'content', 'is_published', 'is_read'];


    public function project():BelongsTo
    {
        return $this->belongsTo(Project::class);
    }


    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name',  'contact', 'sender_name', 'content', 'is_published', 'is_read'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}

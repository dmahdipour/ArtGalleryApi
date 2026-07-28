<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Comment extends Model
{
    use LogsActivity;

    protected $fillable=['project_id', 'parent_id', 'name', 'contact', 'sender_name', 'content', 'is_published', 'is_read'];


    public function project():BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    // کامنت‌های فرزند
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id')->with('replies');
    }

    // کامنت والد
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'parent_id', 'contact', 'sender_name', 'content', 'is_published', 'is_read'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}

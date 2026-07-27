<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Contracts\Loggable;
use Spatie\Activitylog\Traits\LogsActivity;

class Post extends Model
{
    use LogsActivity;

    protected $fillable=['title', 'slug', 'thumbnail', 'description', 'text', 'is_published', 'user_id', 'tags'];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function categories():BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['title', 'slug', 'thumbnail', 'description', 'text', 'is_published', 'user_id', 'tags'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}

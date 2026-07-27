<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
class Link extends Model
{
    use LogsActivity;

    protected $fillable=['name',  'url', 'target', 'click_count', 'status'];

    public function positions():BelongsToMany
    {
        return $this->belongsToMany(Position::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name',  'url', 'target', 'click_count', 'status'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}

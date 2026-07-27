<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class MemberType extends Model
{
    use LogsActivity;

    protected $fillable=['name',  'thumbnail', 'description'];

    public function positions():BelongsToMany
    {
        return $this->belongsToMany(Position::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name',  'thumbnail', 'description'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}

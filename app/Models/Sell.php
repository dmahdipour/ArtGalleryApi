<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sell extends Model
{
    use LogsActivity;

    protected $fillable=['project_id', 'price', 'count', 'location', 'address', 'phone', 'description'];


    public function project():BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['project_id', 'price', 'count', 'location', 'address', 'phone', 'description'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
class Technique extends Model
{
    use LogsActivity;

    protected $fillable=['name_fa', 'name_en', 'description'];



    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name_fa', 'name_en', 'description'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}

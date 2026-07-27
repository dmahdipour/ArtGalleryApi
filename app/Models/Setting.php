<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
class Setting extends Model
{
    use LogsActivity;

    protected $fillable=['name',  'description', 'value', 'file_path'];



    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'description', 'value', 'file_path'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}

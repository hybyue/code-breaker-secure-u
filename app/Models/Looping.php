<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Looping extends Model
{
    use HasFactory, Notifiable, LogsActivity;
    protected $table = 'looping';
    protected $fillable = ['name', 'department', 'date', 'time_in', 'time_out', 'remarks', 'employee_type', 'user_id'];


    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly([
                    'name', 'department', 'date', 'time_in', 'time_out', 'remarks', 'employee_type', 'user_id'
        ])
        ->logOnlyDirty()
        ->dontSubmitEmptyLogs()
        ->logUnguarded()
        ->setDescriptionForEvent(fn(string $eventName) => "This looping record has been {$eventName}")
        ->useLogName('looping');
    }

    protected static $logName = 'looping';


    public function getDescriptionForEvent(string $eventName): string
    {
        return "{$eventName} a Looping Information on id number {$this->id}";
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
}


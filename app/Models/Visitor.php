<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Visitor extends Model
{
    use HasFactory,Notifiable, LogsActivity;

    protected $fillable = [
        'user_id',
        'date',
        'first_name',
        'middle_name',
        'last_name',
        'person_to_visit',
        'purpose',
        'time_in',
        'remarks',
        'time_out',
        'id_type',
    ];

    protected static $logAttributes = [
        'user_id',
        'date',
        'first_name',
        'middle_name',
        'last_name',
        'person_to_visit',
        'purpose',
        'time_in',
        'remarks',
        'time_out',
        'id_type',
    ];


    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['user_id', 'date', 'first_name', 'middle_name', 'last_name', 'person_to_visit', 'purpose', 'time_in', 'remarks', 'time_out', 'id_type'])
            ->logOnlyDirty();
    }

    protected static $logName = 'visitor';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "{$eventName} a Visitor information on ID number {$this->id}";
    }

    public function user(){
        return $this->belongsToMany(User::class);
    }



public static function boot()
{
    parent::boot();

    static::creating(function ($model) {
        $today = Carbon::today();
        $existingEntriesToday = Visitor::where('first_name', $model->first_name)
            ->where('last_name', $model->last_name)
            ->whereDate('created_at', $today)
            ->count();

        $model->entry_count = $existingEntriesToday + 1;
    });
}
}


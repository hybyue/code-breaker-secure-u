<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Event extends Model
{
    use HasFactory,Notifiable, LogsActivity;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'date_start',
        'date_end',
    ];

    protected $casts = [
        'date_start' => 'date',
        'date_end' => 'date',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['user_id', 'title', 'description', 'date_start', 'date_end'])
        ->logOnlyDirty();
    }

    protected static $logName = 'event';

    public function getDescriptionForEvent(string $eventName): string
    {
        return"{$eventName} a Event Information on ID number {$this->id}";
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

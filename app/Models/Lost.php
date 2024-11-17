<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Lost extends Model
{
    use HasFactory,Notifiable, LogsActivity;

    protected $table = 'lost_found';

    protected $fillable = [
        'user_id',
        'object_type',
        'first_name',
        'middle_name',
        'last_name',
        'course',
        'object_img',
        'location',
        'is_claimed',
        'security_staff',
        'description',
        'is_transferred'
    ];


    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly([
        'user_id',
        'object_type',
        'first_name',
        'middle_name',
        'last_name',
        'course',
        'object_img',
        'location',
        'is_claimed',
        'security_staff',
        'description',
        'is_transferred'])
        ->logOnlyDirty()
        ->dontSubmitEmptyLogs()
        ->logUnguarded()
        ->setDescriptionForEvent(fn(string $eventName) => "This lost item record has been {$eventName}")
        ->useLogName('lost_found');
    }

    protected static $logName = 'lost_found';


    public function getDescriptionForEvent(string $eventName): string
    {
        return "{$eventName} a Lost and Found Information on id number {$this->id}";
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

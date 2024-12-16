<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class AllStudent extends Model
{
    use HasFactory, Notifiable, LogsActivity;

    protected $table = 'students';
    protected $fillable = [
        'student_no',
        'first_name',
        'last_name',
        'middle_name',
        'course',
        'user_id',
        'contact_number',
        'address',
        'year_level',
        'email'

    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'student_no',
                'first_name',
                'last_name',
                'middle_name',
                'course',
                'user_id',
                'contact_number',
                'address',
                'year_level',
                'email'
            ])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->logUnguarded()
            ->setDescriptionForEvent(fn(string $eventName) => "This student record has been {$eventName}")
            ->useLogName('all student');
    }

    protected static $logName = 'all student';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "{$eventName} a student information on ID number {$this->student_no} named '{$this->first_name}' ";
    }

    public function user()
    {
        return $this->belongsToMany(User::class);
    }
}

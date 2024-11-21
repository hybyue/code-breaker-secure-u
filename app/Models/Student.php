<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Student extends Model
{
    use HasFactory, Notifiable, LogsActivity;

    protected $fillable = [
        'student_no',
        'first_name',
        'middle_name',
        'last_name',
        'course',
        'email',
        'contact_number',
        'address',
        'year_level',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'student_no',
                'first_name',
                'middle_name',
                'last_name',
                'course',
                'email',
                'contact_number',
                'address',
                'year_level',
            ])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->logUnguarded()
            ->setDescriptionForEvent(fn(string $eventName) => "This student record has been {$eventName}")
            ->useLogName('student');
    }

    protected static $logName = 'student';

    public function getDescriptionForEvent(string $studentName): string
    {
        return"{$studentName} a Student Information on Student ID number {$this->student_no}";
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}

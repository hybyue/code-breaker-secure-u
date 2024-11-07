<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Violation extends Model
{
    use HasFactory, Notifiable, LogsActivity;

    protected $fillable = [
        'user_id',
        'student_no',
        'first_name',
        'middle_initial',
        'last_name',
        'course',
        'violation_type',
        'date',
    ];

    protected static $logAttributes = [
        'user_id',
        'student_no',
        'first_name',
        'middle_initial',
        'last_name',
        'course',
        'violation_type',
        'date',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'user_id',
                'student_no',
                'first_name',
                'middle_initial',
                'last_name',
                'course',
                'violation_type',
                'date'
            ])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->logUnguarded()
            ->setDescriptionForEvent(fn(string $eventName) => "This violation record has been {$eventName}")
            ->useLogName('violation');
    }

    protected static $logName = 'violation';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "{$eventName} a Violation information on ID number {$this->id}";
    }

    public function user(){
        return $this->belongsToMany(User::class);
    }



    public static function boot()
{
    parent::boot();

    static::creating(function ($model) {

        $existingViolation = Violation::where('student_no', $model->student_no)
            ->count();

        $model->violation_count = $existingViolation + 1;
    });
}

}

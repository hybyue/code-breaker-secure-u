<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class PassSlip extends Model
{
    use HasFactory,Notifiable, LogsActivity;

    protected $table = 'pass_slips';

    protected $fillable = [
        'user_id',
        'p_no',
        'first_name',
        'middle_name',
        'last_name',
        'department',
        'designation',
        'destination',
        'date',
        'time_in',
        'time_out',
        'employee_type',
        'purpose',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnly([
        'user_id',
        'p_no',
        'first_name',
        'middle_name',
        'last_name',
        'department',
        'designation',
        'destination',
        'date',
        'time_in',
        'time_out',
        'empployee_type',
        'purpose',
        ])->logOnlyDirty();
    }

    protected static $logName = 'passSlip';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "{$eventName} a Pass Slip information on ID number {$this->id}";
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function boot()
{
    parent::boot();

    static::creating(function ($model) {
        $today = Carbon::today();
        $existingEntriesToday = PassSlip::where('first_name', $model->first_name)
            ->where('last_name', $model->last_name)
            ->where('department', $model->department)
            ->where('designation', $model->designation)
            ->whereDate('created_at', $today)
            ->count();

        $model->exit_count = $existingEntriesToday + 1;
    });
}
}


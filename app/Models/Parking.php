<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Parking extends Model
{
    use HasFactory,Notifiable, LogsActivity;

    protected $fillable = [
        'license_no',
        'first_name',
        'middle_name',
        'last_name',
        'date_registered',
        'expiration_date',
        'license_photo',
        'course',
        'license_exp_date',
        'dl_codes',
        'plate_no',
        'cr_no',
        'cr_date_register',
        'vehicle_type',
        'vehicle_image',
        'sticker_id',
        'user_id',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'license_no',
                'first_name',
                'middle_name',
                'last_name',
                'date_registered',
                'expiration_date',
                'license_photo',
                'course',
                'license_exp_date',
                'dl_codes',
                'plate_no',
                'cr_no',
                'cr_date_register',
                'vehicle_type',
                'vehicle_image',
                'sticker_id',
            ])->logOnlyDirty();
    }
    protected static $logName = 'parking';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "{$eventName} a Parking information on license number {$this->license_no}";
    }

    public function user(){
        return $this->belongsToMany(User::class);
    }
}


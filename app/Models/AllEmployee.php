<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class AllEmployee extends Model
{
    use HasFactory, Notifiable, LogsActivity;
    protected $fillable = [
        'employee_id',
        'first_name',
        'last_name',
        'middle_name',
        'designation',
        'department',
        'status'];

        public function getActivitylogOptions(): LogOptions
        {
            return LogOptions::defaults()
                ->logOnly([
                'employee_id',
                'first_name',
                'last_name',
                'middle_name',
                'designation',
                'department',
                'status'])
                ->logOnlyDirty();
        }

        protected static $logName = 'all employee';

        public function getDescriptionForEvent(string $eventName): string
        {
            return "{$eventName} a Employees information on ID number {$this->employee_id} named '{$this->first_name}' ";
        }

        public function user(){
            return $this->belongsToMany(User::class);
        }
}

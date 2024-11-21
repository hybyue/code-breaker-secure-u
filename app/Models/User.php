<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Cache;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Cache as FacadesCache;
use Spatie\Activitylog\Traits\CausesActivity;

class User extends Authenticatable implements CanResetPassword
{
    use HasFactory,Notifiable, CausesActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'id_number',
        'first_name',
        'middle_name',
        'last_name',
        'gender',
        'civil_status',
        'email_address',
        'contact_no',
        'date_birth',
        'employment_type',
        'last_seen',
        'profile_picture',
        'emergency_contact_name',
        'emergency_contact_number',
        'date_hired',
        'badge_number',
        'schedule',
        'position',
        'province',
        'municipality',
        'barangay',
        'street',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected function type(): Attribute
    {
        return new Attribute(
            get: fn ($value) => ["user", "admin"][$value],
        );
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function pass()
    {
        return $this->hasMany(PassSlip::class);
    }

    public function lost()
    {
        return $this->hasMany(Lost::class);
    }

    public function employ()
    {
        return $this->hasOne(Employee::class, 'email_address', 'email');
    }
    public function visitors(){
        return $this->hasMany(Visitor::class);
    }
    public function  parking(){
        return $this->hasMany(Parking::class);
    }

    public function  violation(){
        return $this->hasMany(Violation::class);
    }
    public function  student(){
        return $this->hasMany(Student::class);
    }
    public function  all_employee(){
        return $this->hasMany(AllEmployee::class);
    }
    public function isOnline()
    {
        return FacadesCache::has('user-is-online-' . $this->id);
    }
}

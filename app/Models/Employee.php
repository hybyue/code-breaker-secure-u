<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employee';

    protected $fillable = [
        'user_id', 'id_number', 'first_name', 'middle_name', 'last_name',
        'gender', 'civil_status', 'email_address', 'contact_no',
        'date_birth', 'employment_type'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'email_address', 'email');
    }

}


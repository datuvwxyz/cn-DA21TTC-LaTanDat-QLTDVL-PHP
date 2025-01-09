<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\Account as Authenticatable;

class Account extends Authenticatable 
{
    use HasFactory; 

    protected $table = 'accounts';
    protected $primaryKey = 'account_id';
    protected $fillable = [
        'user_name',
        'email',
        'tel',
        'password',
        'method',
        'role',
    ];

    protected $casts = [
        'tel' => 'integer',
        'role' => 'string',
    ];

    public function employer()
    {
        return $this->hasMany(Employer::class, 'account_id');
    }

    public function freelancer()
    {
        return $this->hasMany(Freelancer::class, 'account_id');
    }

}

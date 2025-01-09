<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
    use HasFactory;

    protected $table = 'employer';
    protected $primaryKey = 'employer_id';
    public $incrementing = true;
    protected $fillable = [
        'employer_name',
        'date_of_birth',
        'age',
        'address',
        'company_name',
        'introduce',
        'image',
        'account_id',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
    ];

    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id', 'account_id');
    }

    public function jobs()
    {
        return $this->hasMany(PostJob::class, 'employer_id', 'employer_id');
    }
}

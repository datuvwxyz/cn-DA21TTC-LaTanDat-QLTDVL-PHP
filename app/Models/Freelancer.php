<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Freelancer extends Model
{
    use HasFactory;

    protected $table = 'freelancer';
    protected $primaryKey = 'freelancer_id';
    public $incrementing = true;
    protected $fillable = [
        'freelancer_name',
        'date_of_birth',
        'age',
        'address',
        'experements',
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

    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'freelancer_skill', 'freelancer_id', 'skill_id');
    }

    public function postJobs()
    {
        return $this->belongsToMany(PostJob::class, 'post_job_freelancer', 'post_id', 'freelancer_id')
            ->withPivot('cv_file', 'applied_at') 
            ->withTimestamps();
    }
}

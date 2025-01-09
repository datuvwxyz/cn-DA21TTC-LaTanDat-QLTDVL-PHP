<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostJob extends Model
{
    use HasFactory;

    protected $table = 'post_job';

    protected $primaryKey = 'post_id';

    protected $fillable = [
        'title',
        'position',
        'description',
        'expiration_date',
        'area',
        'image',
        'status',
        'employer_id',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }

    public function employer()
    {
        return $this->belongsTo(Employer::class, 'employer_id', 'employer_id');
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'post_job_skill', 'post_id', 'skill_id');
    }

    public function freelancers()
    {
        return $this->belongsToMany(Freelancer::class, 'post_job_freelancer', 'post_id', 'freelancer_id')
            ->withPivot('cv_file', 'applied_at')  
            ->withTimestamps();
    }
}

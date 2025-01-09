<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    protected $table = 'skill';
    protected $primaryKey = 'skill_id';
    public $incrementing = true;
    protected $fillable = [
        'skill_name',
        'field',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }

    public function freelancers()
    {
        return $this->belongsToMany(Freelancer::class, 'freelancer_skill', 'skill_id', 'freelancer_id');
    }

    public function postJobs()
    {
        return $this->belongsToMany(PostJob::class, 'post_job_skill', 'skill_id', 'post_id');
    }
}

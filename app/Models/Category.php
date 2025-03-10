<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $primaryKey = 'category_id';
    public $incrementing = true;
    protected $fillable = [
        'category_name',
        'description'
    ];

    public function skills()
    {
        return $this->hasMany(Skill::class, 'category_id', 'category_id');
    }
}

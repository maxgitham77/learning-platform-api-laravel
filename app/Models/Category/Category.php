<?php

namespace App\Models\Category;

use App\Models\Course\Course;
use App\Traits\WithHashId;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

class Category extends Model
{
    use HasFactory;
    use WithHashId;
    use HasRecursiveRelationships;

    protected $fillable = [
        'name',
        'slug',
        'parent_id',
        'sort_order'
    ];

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

}

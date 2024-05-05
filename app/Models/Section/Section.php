<?php

namespace App\Models\Section;

use App\Models\Course\Course;
use App\Models\Lecture\Lecture;
use App\Traits\WithHashId;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;
    use WithHashId;

    protected $guarded = [];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function lectures()
    {
        return $this->hasMany(Lecture::class);
    }
}

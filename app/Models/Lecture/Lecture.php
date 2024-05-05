<?php

namespace App\Models\Lecture;

use App\Models\Course\Course;
use App\Models\Section\Section;
use App\Traits\WithHashId;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    use HasFactory;
    use WithHashId;

    protected $guarded = [];

    protected $casts = [
        'duration_in_minutes' => 'float'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

}

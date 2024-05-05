<?php

namespace App\Actions\Instructor\Lecture;

use App\Models\Course\Course;

class ReorderLectureAction
{

  public static function run(Course $course)
  {
      // pull out all the lessons that belongsTo the course orderBy the section sub-order as well as the lecture sub-order
     $lectures = $course->lectures()
         ->join('sections', 'sections.id', '=', 'lectures.section_id')
         ->orderBy('sections.sort_order')
         ->orderBy('lectures.sort_order')
         ->select('lectures.*')
         ->get();

     $lectures->each(function ($lecture, $index) {
         $lecture->update([
             'sort_order' => $index+1
         ]);
     });
  }

}

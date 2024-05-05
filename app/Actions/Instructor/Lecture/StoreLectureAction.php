<?php

namespace App\Actions\Instructor\Lecture;

use App\Data\Instructor\Lecture\LectureData;
use App\Models\Section\Section;

class StoreLectureAction
{

  public static function run(LectureData $lectureData, Section $section)
  {
      $max_sort = $section->lectures()->max('sort_order');

      return $section->lectures()->create([
          'course_id' => $section->course_id,
          'title' => $lectureData->title,
          'sort_order' => $max_sort+1,
      ]);
  }

}

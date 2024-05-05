<?php

namespace App\Actions\Instructor\CourseSection;

use App\Models\Course\Course;

class ReorderCourseSectionsAction
{

  public static function run(Course $course)
  {
      $sections = $course->sections()->orderBy('sort_order', 'asc')->get();

      $sections->each(function ($section, $index) {
          $section->update([
              'sort_order' => $index +1
          ]);
      });
  }

}

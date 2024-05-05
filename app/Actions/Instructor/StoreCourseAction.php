<?php

namespace App\Actions\Instructor;

use App\Data\Instructor\StoreCourseData;
use App\Models\Category\Category;
use App\Models\Course\Course;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class StoreCourseAction
{

  public static function run(StoreCourseData $courseData)
  {
        $course = Course::create([
            'user_id' => Auth::id(),
            'title' => $courseData->title,
            'subtitle' => $courseData->subtitle,
            'category_id' => Category::getId($courseData->category),
            'subcategory_id' => Category::getId($courseData->subcategory)
        ]);

        // section
      $section = $course->sections()->create([
          'title' => 'Start here',
          'sort_order' => 1
      ]);

      // lecture
      $section->lectures()->create([
          'course_id' => $course->id,
          'title' => 'Quick Start Introduction',
          'sort_order' => 1
      ]);

        return $course;
  }

}

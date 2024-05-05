<?php

namespace App\Actions\Course;

use App\Data\Course\UpdateCourseData;
use App\Models\Category\Category;
use App\Models\Course\Course;

class UpdateCourseAction
{

  public static function run(UpdateCourseData $updateCourseData, Course $course)
  {
      return tap($course)->update([
          'title' => $updateCourseData->title,
          'subtitle' => $updateCourseData->subtitle,
          'description' => $updateCourseData->description,
          'level' => $updateCourseData->level,
          'category_id' => Category::getId($updateCourseData->category),
          'subcategory_id' => Category::getId($updateCourseData->subcategory)
      ]);

  }

}

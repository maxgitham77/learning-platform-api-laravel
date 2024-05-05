<?php

    namespace App\Actions\Instructor\CourseSection;

    use App\Data\Instructor\CourseSection\SectionData;
    use App\Models\Course\Course;

    class StoreSectionAction
    {
        public static function run(SectionData $sectionData, Course $course)
        {
            $max_sort = $course->sections()->max('sort_order');

            return $course->sections()->create([
                'title' => $sectionData->title,
                'description' => $sectionData->description,
                'sort_order' => $max_sort+1
            ]);
        }
    }

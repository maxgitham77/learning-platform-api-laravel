<?php

    namespace App\Actions\Instructor\CourseSection;

    use App\Data\Instructor\CourseSection\SectionData;
    use App\Models\Section\Section;

    class UpdateSectionAction
    {
        public static function run(SectionData $sectionData, Section $section)
        {
            return tap($section)->update([
                'title' => $sectionData->title,
                'description' => $sectionData->description,
            ]);
        }
    }

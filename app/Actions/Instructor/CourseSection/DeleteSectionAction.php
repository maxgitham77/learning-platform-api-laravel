<?php

    namespace App\Actions\Instructor\CourseSection;

    use App\Models\Section\Section;

    class DeleteSectionAction
    {
        public static function run(Section $section)
        {
            $section->delete();
        }
    }

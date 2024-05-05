<?php

    namespace App\Actions\Instructor\Lecture;

    use App\Data\Instructor\Lecture\LectureData;
    use App\Models\Lecture\Lecture;

    class UpdateLectureAction
    {
        public static function run(LectureData $lectureData, Lecture $lecture)
        {
            return tap($lecture)->update([
                'title' => $lectureData->title
            ]);
        }
    }

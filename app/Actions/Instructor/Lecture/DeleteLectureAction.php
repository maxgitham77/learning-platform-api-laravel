<?php

    namespace App\Actions\Instructor\Lecture;

    use App\Models\Lecture\Lecture;

    class DeleteLectureAction
    {
        public static function run(Lecture $lecture)
        {
            $lecture->delete();
        }
    }

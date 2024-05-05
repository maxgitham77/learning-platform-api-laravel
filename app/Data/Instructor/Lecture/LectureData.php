<?php

    namespace App\Data\Instructor\Lecture;

    use Spatie\LaravelData\Data;

    class LectureData extends Data
    {

        public string $title;

        public static function rules(): array
        {
            return [
                'title' => ['required', 'string', 'max:100']
            ];
        }
    }

<?php

    namespace App\Data\Instructor\Lecture;

    use Spatie\LaravelData\Data;

    class LectureContentData extends Data
    {

        public string $body;

        public static function rules(): array
        {
            return [
                'body' => ['required']
            ];
        }
    }

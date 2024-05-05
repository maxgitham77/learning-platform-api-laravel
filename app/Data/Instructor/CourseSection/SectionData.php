<?php

    namespace App\Data\Instructor\CourseSection;

    use Spatie\LaravelData\Data;

    class SectionData extends Data
    {

        public string $title;
        public ?string $description;

        public static function rules(): array
        {
            return [
                'title' => ['required', 'string', 'max:1000'],
                'description' => ['nullable']
            ];
        }
    }

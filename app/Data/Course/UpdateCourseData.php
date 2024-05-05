<?php

    namespace App\Data\Course;

    use Spatie\LaravelData\Data;

    class UpdateCourseData extends Data
    {

        public string $title;
        public string $subtitle;
        public string $description;
        public string $level;
        public string $category;
        public string $subcategory;

        public static function rules(): array
        {
            return [
                'title' => ['required'],
                'subtitle' => ['required'],
                'category' => ['required', 'exists:categories,hashid'],
                'subcategory' => ['required', 'exists:categories,hashid'],
                'description' => ['required'],
                'level' => ['required', 'string']
            ];
        }
    }

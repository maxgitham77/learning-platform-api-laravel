<?php

    namespace App\Data\Instructor;

    use Spatie\LaravelData\Data;

    class StoreCourseData extends Data
    {

        public string $title;
        public string $subtitle;
        public string $category;
        public string $subcategory;

        public static function rules(): array
        {
            return [
                'title' => ['required', 'string', 'max:255'],
                'subtitle' => ['required', 'string', 'max:255'],
                'category' => ['required', 'exists:categories,hashid'],
                'subcategory' => ['required', 'exists:categories,hashid']
            ];
        }
    }

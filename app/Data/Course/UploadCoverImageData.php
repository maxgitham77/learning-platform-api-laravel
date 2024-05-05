<?php

    namespace App\Data\Course;

    use Illuminate\Http\UploadedFile;
    use Spatie\LaravelData\Data;

    class UploadCoverImageData extends Data
    {

        public UploadedFile $cover_image;

        public static function rules(): array
        {
            return [
                'cover_image' => ['required', 'file', 'mimes:jpg,jpeg,png']
            ];
        }
    }

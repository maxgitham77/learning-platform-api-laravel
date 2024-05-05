<?php

    namespace App\Actions\Course;

    use App\Data\Course\UploadCoverImageData;
    use App\Models\Course\Course;

    class UploadCoverImageAction
    {
        public static function run(UploadCoverImageData $coverImageData, Course $course)
        {
            tap($course->getFirstMedia('cover'), function ($previous) use ($coverImageData, $course) {
                $course->addMedia($coverImageData->cover_image)->toMediaCollection('cover');

                if ($previous) {
                    $previous->delete();
                }
            });

            return $course->fresh();
        }
    }

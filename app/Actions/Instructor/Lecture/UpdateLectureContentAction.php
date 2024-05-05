<?php

    namespace App\Actions\Instructor\Lecture;

    use App\Data\Instructor\Lecture\LectureContentData;
    use App\Models\Lecture\Lecture;

    class UpdateLectureContentAction
    {
        public static function run(LectureContentData $lectureContentData, Lecture $lecture)
        {
            return tap($lecture)->update([
                'body' => $lectureContentData->body,
                'type' => 'text',
                'duration_in_minutes' => self::calculateContentReadingTime($lectureContentData->body)
            ]);
        }

        protected static function calculateContentReadingTime(string $text)
        {
            $wod_count = str_word_count(strip_tags($text));
            return round($wod_count / 200, 2);
        }
    }

<?php

namespace App\Http\Controllers\Instructor\Lecture;

use App\Actions\Instructor\Lecture\UpdateLectureAction;
use App\Actions\Instructor\Lecture\UpdateLectureContentAction;
use App\Data\Instructor\Lecture\LectureContentData;
use App\Http\Controllers\Controller;
use App\Http\Resources\LectureResource;
use App\Models\Course\Course;
use App\Models\Lecture\Lecture;
use Illuminate\Http\Request;

class LectureContentController extends Controller
{
    public function update(LectureContentData $lectureContentData, Course $course, Lecture $lecture)
    {
        $lecture = UpdateLectureContentAction::run($lectureContentData, $lecture);
        return LectureResource::make($lecture);
    }

    public function upload(Request $request, Lecture $lecture)
    {}
}

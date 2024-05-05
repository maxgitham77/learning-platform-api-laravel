<?php

    namespace App\Http\Controllers\Instructor\Lecture;

    use App\Actions\Instructor\Lecture\DeleteLectureAction;
    use App\Actions\Instructor\Lecture\ReorderLectureAction;
    use App\Actions\Instructor\Lecture\StoreLectureAction;
    use App\Actions\Instructor\Lecture\UpdateLectureAction;
    use App\Data\Instructor\Lecture\LectureData;
    use App\Http\Controllers\Controller;
    use App\Http\Resources\LectureResource;
    use App\Http\Resources\SectionResource;
    use App\Models\Course\Course;
    use App\Models\Lecture\Lecture;
    use App\Models\Section\Section;
    use Illuminate\Http\Request;

    class LectureController extends Controller
    {
        public function store(LectureData $lectureData, Course $course, Section $section)
        {
            $this->authorize('update', $course);
            $lecture = StoreLectureAction::run($lectureData, $section);
            ReorderLectureAction::run($course);
            return LectureResource::make($lecture->fresh());
        }

        public function update(LectureData $lectureData, Course $course, Lecture $lecture)
        {
            $this->authorize('update', $course);
            $lecture = UpdateLectureAction::run($lectureData, $lecture);
            return LectureResource::make($lecture);
        }

        public function destroy(Course $course, Lecture $lecture)
        {
            $this->authorize('update', $course);
            DeleteLectureAction::run($lecture);
            ReorderLectureAction::run($course);
            return SectionResource::collection($course->sections()->load('lectures'));
        }
    }

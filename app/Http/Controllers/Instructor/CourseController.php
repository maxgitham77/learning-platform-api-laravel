<?php

    namespace App\Http\Controllers\Instructor;

    use App\Actions\Category\GetAllCategoryAction;
    use App\Actions\Course\GetInstructorCourseAction;
    use App\Actions\Course\UpdateCourseAction;
    use App\Actions\Course\UpdateCourseStatusAction;
    use App\Actions\Course\UploadCoverImageAction;
    use App\Actions\Instructor\StoreCourseAction;
    use App\Data\Course\UpdateCourseData;
    use App\Data\Course\UploadCoverImageData;
    use App\Data\Instructor\StoreCourseData;
    use App\Http\Controllers\Controller;
    use App\Http\Resources\CategoryResource;
    use App\Http\Resources\CourseResource;
    use App\Models\Course\Course;
    use Illuminate\Http\Request;
    use Symfony\Component\HttpFoundation\Response;

    class CourseController extends Controller
    {
        /**
         * Handle the incoming request.
         */
        public function index()
        {
            $courses = GetInstructorCourseAction::run();
            return CourseResource::collection($courses);
        }

        public function store(StoreCourseData $courseData)
        {
            $course = StoreCourseAction::run($courseData);
            return CourseResource::make($course);
        }

        public function show(Course $course)
        {
            return CourseResource::make($course->load('author', 'category'));
        }

        public function getCourseBasicInformations(Course $course)
        {
            return response()->json([
                'course' => CourseResource::make($course->load('category')),
                'categories' => CategoryResource::collection(GetAllCategoryAction::run())
            ]);
        }

        public function updateCourseBasicInformations(UpdateCourseData $updateCourseData, Course $course)
        {
            $this->authorize('update', $course);
            $course = UpdateCourseAction::run($updateCourseData, $course);
            return CourseResource::make($course->load('category'));
        }

        /**
         * getCurriculumForCourse: these are all the sections for the course, all the sections for the course, etc.
         */
        public function getCurriculumForCourse(Course $course)
        {
        }

        /**
         * the cover image for the course
         */
        public function uploadCoverImage(UploadCoverImageData $coverImageData, Course $course)
        {
            $this->authorize('update', $course);
            $course = UploadCoverImageAction::run($coverImageData, $course);
            return CourseResource::make($course);
        }

        public function updateCourseStatus(Course $course)
        {
            $this->authorize('update', $course);
            abort_unless($course->canBePublished(), Response::HTTP_UNAUTHORIZED, 'Course not ready for status change');
            UpdateCourseStatusAction::run($course);
            return CourseResource::make($course->fresh());
        }
    }

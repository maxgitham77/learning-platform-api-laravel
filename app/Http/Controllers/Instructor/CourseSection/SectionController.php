<?php

    namespace App\Http\Controllers\Instructor\CourseSection;

    use App\Actions\Instructor\CourseSection\DeleteSectionAction;
    use App\Actions\Instructor\CourseSection\ReorderCourseSectionsAction;
    use App\Actions\Instructor\CourseSection\StoreSectionAction;
    use App\Actions\Instructor\CourseSection\UpdateSectionAction;
    use App\Data\Instructor\CourseSection\SectionData;
    use App\Http\Controllers\Controller;
    use App\Http\Resources\SectionResource;
    use App\Models\Course\Course;
    use App\Models\Section\Section;
    use Illuminate\Http\Request;
    use Symfony\Component\HttpFoundation\Response;

    class SectionController extends Controller
    {
        public function store(SectionData $sectionData, Course $course)
        {
            $this->authorize('update', $course);
            $section = StoreSectionAction::run($sectionData, $course);
            return SectionResource::make($section);
        }

        public function update(SectionData $sectionData, Course $course, Section $section)
        {
            $this->authorize('update', $course);
            $section = UpdateSectionAction::run($sectionData, $section);
            return SectionResource::make($section);
        }

        public function destroy(Course $course, Section $section)
        {
            $this->authorize('update', $course);
            DeleteSectionAction::run($section);
            ReorderCourseSectionsAction::run($section);
            return response()->json(null, Response::HTTP_OK);
        }
    }

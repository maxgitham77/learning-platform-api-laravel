<?php

    use App\Http\Controllers\Auth\API\EmailVerificationController;
    use App\Http\Controllers\Auth\API\LoginController;
    use App\Http\Controllers\Auth\API\MeController;
    use App\Http\Controllers\Auth\API\RegistrationController;
    use App\Http\Controllers\Category\CategoryController;
    use App\Http\Controllers\Instructor\CourseController;
    use App\Http\Controllers\Instructor\CourseSection\SectionController;
    use App\Http\Controllers\Instructor\Lecture\LectureContentController;
    use App\Http\Controllers\Instructor\Lecture\LectureController;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Route;

    /*
    |--------------------------------------------------------------------------
    | AUTHENTICATED Routes
    |--------------------------------------------------------------------------*/
    Route::group(['prefix' => 'auth'], function () {
        Route::post('/register', [RegistrationController::class, '__invoke']);
        Route::post('/login', [LoginController::class, 'store']);
        Route::middleware('auth:sanctum')->group(function () {
            Route::get('/me', [MeController::class, '__invoke']);
            Route::post('/logout', [LoginController::class, 'destroy']);
            Route::controller(EmailVerificationController::class)->group(function () {
                Route::post('email/verification-notification', 'sendVerificationEmail')->middleware(['throttle:6,1']);
                Route::get('verify-email/{user}/{hash}', 'verify')->name('verification.verify');
            });
        });
    });
    Route::get('/categories', [CategoryController::class, '__invoke']);

    /*
    |--------------------------------------------------------------------------
    | INSTRUCTOR Routes
    |--------------------------------------------------------------------------*/
    Route::scopeBindings()->group(function () {
        Route::group([
            'middleware' => 'auth:sanctum',
            'prefix' => 'instructor'
        ], function () {
            // Courses basic information
            Route::controller(CourseController::class)->group(function () {
                Route::get('/courses', 'index');
                Route::post('/courses', 'store');
                Route::get('/courses/{course}', 'show');
                Route::get('/courses/{course}/basic', 'getCourseBasicInformations');
                Route::put('/courses/{course}/basic', 'updateCourseBasicInformations');
                Route::put('/courses/{course}/status', 'updateCourseStatus');
                Route::post('/courses/{course}/cover', 'uploadCoverImage');
                Route::get('/courses/{course}/curriculum', 'getCurriculumForCourse');
            });

            // Course Sections
            Route::controller(SectionController::class)->group(function () {
                Route::post('/courses/{course}/sections', 'store');
                Route::put('/courses/{course}/sections/{sections}', 'update');
                Route::delete('/courses/{course}/sections/{sections}', 'destroy');
            });

            // Course lectures
            Route::controller(LectureController::class)->group(function () {
                Route::post('/courses/{course}/sections/{section}/lectures', 'store');
                Route::put('/courses/{course}/lectures/{lecture}', 'update');
                Route::delete('/courses/{course}/lectures/{lecture}', 'destroy');
            });

            // Lecture Content
            Route::controller(LectureContentController::class)->group(function () {
            Route::put('/courses/{course}/lectures/{lecture}/content', 'update');
            Route::post('/lectures/{lecture}/chunk', 'upload');
            });

        });
    });

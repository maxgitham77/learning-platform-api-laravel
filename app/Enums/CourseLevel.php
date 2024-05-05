<?php

    namespace App\Enums;


    enum CourseLevel : string
    {
        case ALL            = 'all';
        case BEGINNER       = 'beginner';
        case INTERMEDIATE   = 'intermediate',
        case ADVANCED       = 'advanced';
    }

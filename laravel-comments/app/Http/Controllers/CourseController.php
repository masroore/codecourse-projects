<?php

namespace App\Http\Controllers;

use App\Course;

class CourseController extends Controller
{
    public function show(Course $course)
    {
        return view('courses.show', compact('course'));
    }
}

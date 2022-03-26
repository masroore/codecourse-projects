<?php

namespace App\Http\Controllers;

use App\Lesson;

class LessonController extends Controller
{
    public function index()
    {
        $lessons = Lesson::get();

        return view('lesson.index', compact('lessons'));
    }

    public function show(Lesson $lesson)
    {
        return view('lesson.show', compact('lesson'));
    }
}

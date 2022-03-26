<?php

namespace App\Http\Controllers\Courses;

use App\Course;
use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use Illuminate\Http\Request;

class CourseCommentController extends Controller
{
    public function index(Course $course)
    {
        return CommentResource::collection(
            $course->comments()->with(['children', 'user'])->paginate(3)
        );
    }

    public function store(Course $course, Request $request)
    {
        $this->validate($request, [
            'body' => 'required|max:5000',
        ]);

        $comment = $course->comments()->make([
            'body' => $request->body,
        ]);

        $request->user()->comments()->save($comment);

        return new CommentResource($comment);
    }
}

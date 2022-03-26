<?php

namespace Imagine\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageController extends Controller
{
    protected $allowedFileExtensions = [
        'png',
        'jpg',
        'gif',
    ];

    public function index($name)
    {
        if (!Storage::disk('s3')->exists($this->buildFilePath($name))) {
            abort(404);
        }

        return view('image.index')->with([
            'image' => $this->buildAbsoluteFilePath($name),
        ]);
    }

    public function create(Request $request)
    {
        $file = $request->file('image');

        if (!$file) {
            return redirect()->back();
        }

        if (!$this->isAllowedFile($file)) {
            return redirect()->back();
        }

        $name = str_random(255) . '.' . $file->getClientOriginalExtension();

        Storage::disk('s3')->put(
            $this->buildFilePath($name),
            file_get_contents($file->getRealPath())
        );

        return redirect()->route('image.index', [
            'name' => $name,
        ]);
    }

    protected function isAllowedFile(UploadedFile $file)
    {
        return \in_array(
            $file->getClientOriginalExtension(),
            $this->allowedFileExtensions
        );
    }

    protected function buildFilePath($name)
    {
        return 'images/' . $name;
    }

    protected function buildAbsoluteFilePath($name)
    {
        return 'https://s3.amazonaws.com/imagine.app/' . $this->buildFilePath($name);
    }
}

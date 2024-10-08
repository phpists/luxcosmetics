<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\FileService;
use Illuminate\Http\Request;

class CkeditorController extends Controller
{
    const UPLOADS_PATH = 'ckeditor/uploads';

    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            if (\Storage::disk('uploads')->put(self::UPLOADS_PATH, $file)) {
                return \Response::json([
                    'uploaded' => 1,
                    'fileName' => $file->hashName(),
                    'url' => asset('images/uploads/' . self::UPLOADS_PATH . '/' . $file->hashName()),
                ]);
            } else {
                return \Response::json([
                    'uploaded' => 0,
                    'error' => [
                        'message' => 'ERROR! File could not be saved'
                    ]
                ]);
            }
        }

        return \Response::json([
            'uploaded' => 0,
            'error' => [
                'message' => 'ERROR! File not received'
            ]
        ]);
    }
}

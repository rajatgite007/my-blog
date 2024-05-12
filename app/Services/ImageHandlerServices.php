<?php

namespace App\Services;
use Illuminate\Support\Facades\Storage;

class ImageHandlerServices
{
    public function handleUploadedImage($image,$CKEditorFuncNum)
    {
        if ($image !== null) {
            $originName = $image->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $image->getClientOriginalExtension();
            $fileName = $fileName . '.' . $extension;

            $image->move(public_path('images'), $fileName);

            $url = asset('images/' . $fileName);
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url')</script>";

            @header('Content-type: text/html; charset=utf-8');
            echo $response; die();
            return response()->json(['url' => $url]);
        }
    }
}
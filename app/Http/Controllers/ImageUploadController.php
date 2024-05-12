<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ImageHandlerServices;
use Illuminate\Database\QueryException;
use Maatwebsite\Excel\Facades\Excel;

class ImageUploadController extends Controller
{
    private $ImageHandlerServices;

    public function __construct(
        ImageHandlerServices $imageHandlerServices,
    ) {
        $this->imageHandlerServices = $imageHandlerServices;
    }

    public function uploadImage(Request $request)
    {
        $this->imageHandlerServices->handleUploadedImage(
            $request->file('upload'),
            $request->input('CKEditorFuncNum')
        );
    }
}

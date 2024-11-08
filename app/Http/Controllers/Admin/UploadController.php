<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\UploadService;

class UploadController extends Controller
{
    protected $upload;

    public function __construct(UploadService $upload)
    {
        $this->upload = $upload;
    }

    public function store(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $this->upload->uploadFile($file);
    
            if ($path) {
                return response()->json(['success' => true, 'url' => $path]);
            }
        }
    
        return response()->json(['success' => false]);
    }
    
}
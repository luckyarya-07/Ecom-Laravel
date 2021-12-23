<?php

namespace App\Http\Controllers;

use App\Models\TemporaryFiles;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function store( Request $request ) {

        if ($request->hasFile('multi_img')) {
           $file = $request->file('multi_img');
           $filename = $file->getClientOriginalName();
           $folder = uniqid() . '-' . now()->timestamp;
           $file->storeAs('uploads/temp/' . $folder, $filename);
          
           TemporaryFiles::create([
               'folder' => $folder,
               'filename' => $filename
           ]);

           return $folder;
        }
        
        return '';

    }
}

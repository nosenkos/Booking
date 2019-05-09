<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function store(Request $request){
        $file = $request->file('file');

        $media = Media::create([
            'object_id'=>'0',
            'image'=>$file
        ]);

        return $media;
    }
}

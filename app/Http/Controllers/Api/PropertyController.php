<?php

namespace App\Http\Controllers\Api;

use App\Models\PropertyObject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PropertyController extends Controller
{
    public function allPaginated(){
        return PropertyObject::orderBy('id','DESC')->with('media')->paginate(20);
    }
}

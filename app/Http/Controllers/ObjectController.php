<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\PropertyObject;
use Illuminate\Http\Request;

class ObjectController extends Controller
{
    public function index(){
        return view('property.index');
    }

    public function show(PropertyObject $property){
        $property = PropertyObject::where('id',$property->id)->with('media')->first();
        return view('property.show', compact('property'));
    }

    public function create(){
        return view('property.create');
    }

    public function store(Request $request){
        $request->validate([
            'title'=>'required|string',
            'description'=>'required|string',
            'country'=>'nullable|integer',
            'state'=>'nullable|integer',
            'city'=>'nullable|integer',
            'lat'=>'nullable|numeric',
            'lon'=>'nullable|numeric',
            'price_per_day'=>'required|numeric'
        ]);

        $property = PropertyObject::create([
            'user_id'=>auth()->user()->id,
            'title'=>$request->title,
            'description'=>$request->description,
            'country_id'=>$request->country,
            'state_id'=>$request->state,
            'city_id'=>$request->city,
            'lat'=>$request->lat,
            'lon'=>$request->lon,
            'price_per_day'=>$request->price_per_day
        ]);

        if($property){
            if(collect($request->media)->count()){
                foreach($request->media as $media){
                    $image = Media::find($media);
                    $image->object_id = $property->id;
                    $image->save();
                }
            }
            return $property;
        }

        return "0";
    }
}















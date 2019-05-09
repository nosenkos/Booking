<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use SahusoftCom\EloquentImageMutator\EloquentImageMutatorTrait;

class Media extends Model
{
    use EloquentImageMutatorTrait;

    protected $fillable = ['object_id','image'];

    protected $image_fields = ['image'];
}

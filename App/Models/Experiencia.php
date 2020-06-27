<?php

namespace App\Models;

use App\Traits\HasDefaultImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Experiencia extends Model
{
    use HasDefaultImage;
    use SoftDeletes;

    protected $table = 'experiencias';


}


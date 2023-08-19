<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DClass extends Model
{
    use HasFactory;

    function batch() {
        return $this->belongsTo(DClass::class);
    }

}

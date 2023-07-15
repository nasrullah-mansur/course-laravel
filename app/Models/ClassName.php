<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassName extends Model
{
    use HasFactory;

    function topics() {
        return $this->hasMany(ClassTopic::class)->orderBy('serial');
    }
}

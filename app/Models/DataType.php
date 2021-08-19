<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataType extends Model
{
    use HasFactory;

    protected $guarded = [];

     /**
     * A datatype consists of many questions.
     */
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'nationality',
        'date_of_birth',
        'phone',
        'next_of_kin',
        'next_of_kin_phone',
        'id_number',
        'id_type',
		'unique_id'
    ];

    /**
     * A subject consists of many questionnaires.
     */
    public function questionnaires()
    {
        return $this->hasMany(Questionnaire::class);
    }

    /**
     * A subject consists of many subject trackers.
     */
    public function subject_trackings()
    {
        return $this->hasMany(SubjectTracking::class);
    }
}

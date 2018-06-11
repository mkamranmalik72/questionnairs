<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Choice extends Model
{
    protected $table = 'choices';
    protected $fillable = [
        'question_id',
        'choice',
        'is_correct'
    ];
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public function question(){
        return $this->belongsTo(Question::class,'question_id','id');
    }
}

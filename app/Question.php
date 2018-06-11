<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';
    protected $fillable = [
        'questionnair_id',
        'type',
        'question'
    ];
    protected $dates = [
        'created_at',
        'updated_at'
    ];
    public static $types = ['Text', 'Multiple Choice (Single Option)', 'Multiple Choice (Multiple Option)'];

    public function questionnair(){
        return $this->belongsTo(Questionnair::class,'questionnair_id','id');
    }
    public function choices(){
        return $this->hasMany(Choice::class,'question_id','id');
    }
    public static function types(){
        return self::$types;
    }
}

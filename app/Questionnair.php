<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questionnair extends Model
{

    protected $table = 'questionnairs';
    protected $fillable = [
        'user_id',
        'name',
        'duration',
        'duration_type',
        'resumeable',
        'published',
    ];
    protected $dates = [
        'created_at',
        'updated_at'
    ];
    public static $duration_type = ['Minute', 'Hour'];
    public static $resumeable = ['No', 'Yes'];
    public static $published = ['No', 'Yes'];

    public function duration_types(){
        return self::$duration_type;
    }
    public function questions(){
        return $this->hasMany(Question::class,'questionnair_id','id');
    }
    public function getDurationAttribute(){
        if (isset(self::$duration_type[$this->getOriginal('duration_type')])){
            return $this->getOriginal('duration') .' '. self::$duration_type[$this->getOriginal('duration_type')];
        }else{
            return $this->getOriginal('duration');
        }
    }
    public function getResumeableAttribute(){
        if (isset(self::$resumeable[$this->getOriginal('resumeable')])){
            return self::$resumeable[$this->getOriginal('resumeable')];
        }else{
            return $this->getOriginal('resumeable');
        }
    }
    public function getPublishedAttribute(){
        return self::$published[$this->getOriginal('published')];
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question_pictures extends Model
{
    protected $table = 'Question_pictures';
    public $timestamps = false;
    protected $primaryKey = 'question_pic_id';
}

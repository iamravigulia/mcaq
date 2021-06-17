<?php
namespace Edgewizz\Mcaq\Models;

use Illuminate\Database\Eloquent\Model;

class McaqQues extends Model{
    public function answers(){
        return $this->hasMany('Edgewizz\Mcaq\Models\McaqAns', 'question_id');
    }
    protected $table = 'fmt_mcaq_ques';
}
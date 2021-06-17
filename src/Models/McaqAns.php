<?php
namespace Edgewizz\Mcaq\Models;

use Illuminate\Database\Eloquent\Model;

class McaqAns extends Model
{
    public function match(){
        return $this->belongsTo('Edgewizz\Mcaq\Models\McaqAns', 'match_id');
    }
    protected $table = 'fmt_mcaq_ans';
}

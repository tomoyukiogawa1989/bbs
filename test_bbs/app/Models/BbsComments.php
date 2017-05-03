<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BbsComments extends Model
{
    protected $connection = 'mysql';

    protected $table = 'bbs_comments';

    protected $fillable = [
        'bbs_id',
        'user_id',
        'comment',
    ];
    
    protected $guarded =['id'];

/*
    public function scopeSendmail($query)
    {
        return $query->where('filename', null);
    }
*/
}


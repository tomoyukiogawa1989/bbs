<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bbs extends Model
{
    protected $connection = 'mysql';

    protected $table = 'bbs';

    protected $fillable = [
        'user_id',
        'title',
        'image',
        'content',
        'comment_count',
    ];
    
    protected $guarded =['id'];

/*
    public function scopeSendmail($query)
    {
        return $query->where('filename', null);
    }
*/
}


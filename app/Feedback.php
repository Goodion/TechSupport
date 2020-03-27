<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    public $guarded = [];
    public $table = 'feedbacks';

    public function author()
    {
        return $this->belongsTo(User::class);
    }

    public function appeals()
    {
        return $this->belongsTo(\App\Appeal::class);
    }
}

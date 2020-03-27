<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Appeal extends Model
{
    public $guarded = [];

    public function isNotClosed()
    {
        return (bool)! $this->closed;
    }

    public function newCollection(array $models =[])
    {
        return new Class($models) extends Collection
        {
            public function allOpened()
            {
                return $this->filter->isNotClosed();
            }
        };
    }

    public function author()
    {
        return $this->belongsTo(User::class);
    }
}

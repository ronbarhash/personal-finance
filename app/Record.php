<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    protected $fillable = ['title, cost, event_type'];

    public $timestamps = false;
}

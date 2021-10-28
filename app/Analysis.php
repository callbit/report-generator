<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Analysis extends Model
{
    protected $fillable = ['name', 'introduction', 'conclusion', 'status', 'user_id'];
    protected $guarded = [];
    public $timestamps = true;
}

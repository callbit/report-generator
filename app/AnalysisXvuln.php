<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnalysisXvuln extends Model
{
    protected $fillable = ['vulName', 'vulDescription', 'vulRecomendation', 'vulReference', 'vulRisk'];
    protected $guarded = [];
    public $timestamps = true;
}

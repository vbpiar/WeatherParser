<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WeatherPrediction extends Model
{
    protected $fillable = [
        'time', 'temperature','wind','rain',
    ];
}

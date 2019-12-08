<?php

namespace App\Http\Controllers;

use App\Facades\ParseService;


class WeatherController extends Controller
{
    public function index()
    {
        $html = ParseService::loadHtmlBody(env('WEATHER_PREDICTION_URL'));
        $weather = ParseService::parseGismeteo($html);
        return view('weather',['weather'=>$weather]);
    }

}

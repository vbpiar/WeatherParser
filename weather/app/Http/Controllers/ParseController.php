<?php

namespace App\Http\Controllers;

use App\WeatherPrediction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\DomCrawler\Crawler;
//use GuzzleHttp\Client;

class ParseController extends Controller
{
    public function index()
    {
$weather =$this->getContent();


return view('weather',['weather'=>$weather]);
    }

    private function loadHtml()
    {

        return   file_get_contents(env('WEATHER_PREDICTION_URL'));


    }
    
    public function getContent( )
    {

// Get html remote text.
      ( $html =  $page = $this->loadHtml());


// Create new instance for parser.
        $crawler = new Crawler();
        $crawler->addHtmlContent($html, 'UTF-8');

        $weatherArray = [];
// Get title text.
        for ($i=1;$i<=8;$i++) {

            $weather = new WeatherPrediction();

            $time=$crawler->filter("body > section > div.content_wrap > div > div.main > div > div.__frame_sm > div.forecast_frame.hw_wrap > div.widget__wrap > div > div.widget__body > div > div.widget__row.widget__row_time > div:nth-child($i) > div ")->attr('title');
            $weather->time = $time;
            $weather->temperature = $crawler->filter("body > section > div.content_wrap > div > div.main > div > div.__frame_sm > div.forecast_frame.hw_wrap > div.widget__wrap > div > div.widget__body > div > div.widget__row.widget__row_table.widget__row_temperature > div > div > div > div:nth-child($i) > span.unit.unit_temperature_c")->text('n/a');
            $weather->wind =$crawler->filter("body > section > div.content_wrap > div > div.main > div > div.__frame_sm > div.forecast_frame.hw_wrap > div.widget__wrap > div > div.widget__body > div > div.widget__row.widget__row_table.widget__row_wind-or-gust > div:nth-child($i) > div > div > span.unit.unit_wind_m_s")->text('n/a');
            $weather->rain =$crawler->filter("body > section > div.content_wrap > div > div.main > div > div.__frame_sm > div.forecast_frame.hw_wrap > div.widget__wrap > div > div.widget__body > div > div.widget__row.widget__row_table.widget__row_precipitation > div:nth-child($i) > div > div")->text('n/a');
            $weatherArray[]= $weather;
        }


        return $weatherArray;
    }
}

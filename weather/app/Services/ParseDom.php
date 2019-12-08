<?php


namespace App\Services;


use App\WeatherPrediction;
use Symfony\Component\DomCrawler\Crawler;

class ParseDom
{

    public function parseGismeteo(string $html,$count = 8)
    {
        $crawler = new Crawler();
        $crawler->addHtmlContent($html, 'UTF-8');
        $weatherArray = [];

        //extract all values from body and put them into WeatherPrediction model

        for ($i=1;$i<=$count;$i++) {

            $weather = new WeatherPrediction();
            $weather->time = $crawler->filter("body > section > div.content_wrap > div > div.main > div > div.__frame_sm > div.forecast_frame.hw_wrap > div.widget__wrap > div > div.widget__body > div > div.widget__row.widget__row_time > div:nth-child($i) > div ")->attr('title');
            $weather->temperature = $crawler->filter("body > section > div.content_wrap > div > div.main > div > div.__frame_sm > div.forecast_frame.hw_wrap > div.widget__wrap > div > div.widget__body > div > div.widget__row.widget__row_table.widget__row_temperature > div > div > div > div:nth-child($i) > span.unit.unit_temperature_c")->text('n/a');
            $weather->wind =$crawler->filter("body > section > div.content_wrap > div > div.main > div > div.__frame_sm > div.forecast_frame.hw_wrap > div.widget__wrap > div > div.widget__body > div > div.widget__row.widget__row_table.widget__row_wind-or-gust > div:nth-child($i) > div > div > span.unit.unit_wind_m_s")->text('n/a');
            $weather->rain =$crawler->filter("body > section > div.content_wrap > div > div.main > div > div.__frame_sm > div.forecast_frame.hw_wrap > div.widget__wrap > div > div.widget__body > div > div.widget__row.widget__row_table.widget__row_precipitation > div:nth-child($i) > div > div")->text('n/a');
            $weatherArray[]= $weather;
        }


        return $weatherArray ;
}

    public function loadHtmlBody(string $url)
    {
        $options = array(
            CURLOPT_RETURNTRANSFER => true,     // return web page
            CURLOPT_HEADER         => false,    // don't return headers
            CURLOPT_FOLLOWLOCATION => true,     // follow redirects
            CURLOPT_ENCODING       => "",       // handle all encodings
            CURLOPT_USERAGENT      => "",       // who am i
            CURLOPT_AUTOREFERER    => true,     // set referer on redirect
            CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
            CURLOPT_TIMEOUT        => 120,      // timeout on response
            CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
            CURLOPT_SSL_VERIFYPEER => false     // Disabled SSL Cert checks
        );

        $ch      = curl_init( $url );
        curl_setopt_array( $ch, $options );
        $content = curl_exec( $ch );
        $header  = curl_getinfo( $ch );
        curl_close( $ch );


        $header['content'] = $content;
        return $header['content'];
    }
}
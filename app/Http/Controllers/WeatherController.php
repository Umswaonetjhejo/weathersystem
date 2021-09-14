<?php

namespace App\Http\Controllers;

use App\Models\Weather;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Collection;

class WeatherController extends Controller
{
    //
    public function index()
    {
        //Declare units and language variables
        $units = 'metric';
        $lan = 'en';

        //Call method to get location
        $location = $this->location();

        //Call method to get today's weather
        $todayWeather = $this->weather($location['city'], $location['country_code'], $units, $lan);

        $saveTodayWeather = $this->saveTodayWeather($todayWeather);

        if($saveTodayWeather == true)
        {
            //Call method to get weather for the next 5 days
            $next5days = $this->next5days($location['city'], $location['country_code'], $units, $lan);
        }

        //Declare and array to store future dates weather form $next5days list element
        $futureDates = array();

        //Declare counter to count element to be stored in $futureDate array
        $counter = 0;

        $todaysDate = date("Y-m-d");

        //Loop to populate $futureDate array
        for ($x = 0; $x < $next5days['cnt']; $x++) {

            //Check if the date is in $next5day list elements are greater the current date.
            if(substr($next5days['list'][$x]['dt_txt'], 0,10) > $todaysDate)
            {
                //Populate the $futureDate array
                $futureDates[] = $next5days['list'][$x];

                //Change date to the day of the current date of list array
                $todaysDate = substr($next5days['list'][$x]['dt_txt'], 0,10);

                //Increment counter
                $counter++;
            }

            //Check if counter has equal to 5 to terminate the loop
            if($counter == 5)
            {
                //Terminate the loop
                $x = $next5days['cnt'];
            }

        }
        //dump($todayWeather);

        //dump($futureDates);

        if($todayWeather['weather'][0]['main'] == 'Clear')
        {
            $color = '#eabc46';
            $image = 'ic_sunny.png';
        }
        elseif($todayWeather['weather'][0]['main'] == 'Rain')
        {
            $color = '#56565c';
            $image = 'ic_rainy.png';
        }
        else
        {
            $color = '#638593';
            $image = 'ic_cloudy.png';
        }

        return view('index', [
            'todayWeather' => $todayWeather,
            'futureDates' => $futureDates,
            'color' => $color,
            'image' => $image
        ]);
    }

    public function location()
    {
        //Url to get current location
        $currentLocationUrl = 'https://geolocation-db.com/json/ac71b0c0-1248-11ec-b75e-4962cc3311c9';

        //Get user location
        $currentLocation = Http::get($currentLocationUrl)->json();

        return $currentLocation;
    }

    public function weather($city, $county_code, $units, $lan)
    {
        //Url to get today's weather
        $todayWeatherUrl = 'https://api.openweathermap.org/data/2.5/weather?q='.$city.','.$county_code.'&appid=b752d7a3f9ecdba97feecc9cf4000ff0&units='.$units.'&lang'.$lan;

        //Get today's weather from https://openweathermap.org/current
        $todayWeather = Http::get($todayWeatherUrl)->json();

        return $todayWeather;
    }

    public function next5days($city, $county_code, $units, $lan)
    {
        //Url to get the weather for the next coming 5 days
        $next5daysUrl = 'https://api.openweathermap.org/data/2.5/forecast?q='.$city.','.$county_code.'&appid=b752d7a3f9ecdba97feecc9cf4000ff0&units='.$units.'&lang'.$lan;

        //Get weather https://openweathermap.org/current
        $next5daysWeather = Http::get($next5daysUrl)->json();

        return $next5daysWeather;
    }

    public function saveTodayWeather($todayWeather)
    {
        //Remove the rows from the table
        Weather::truncate('weather');
        $weather = new Weather();
        $weather->id = $todayWeather['id'];
        $weather->coord = $todayWeather['coord'];
        $weather->weather = $todayWeather['weather'];
        $weather->base = $todayWeather['base'];
        $weather->main = $todayWeather['main'];
        $weather->visibility = $todayWeather['visibility'];
        $weather->wind = $todayWeather['wind'];
        $weather->clouds = $todayWeather['clouds'];
        $weather->dt = $todayWeather['dt'];
        $weather->sys = $todayWeather['sys'];
        $weather->timezone = $todayWeather['timezone'];
        $weather->name = $todayWeather['name'];
        $weather->cod = $todayWeather['cod'];

        return $weather->save();
    }
}

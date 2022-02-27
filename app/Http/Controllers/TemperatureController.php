<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use App\Repository\TemperatureRepositoryInterface;
use App\Repository\CityRepositoryInterface;
use Auth;

class TemperatureController extends Controller
{
    private $temperature_repository;
    private $city_repository;

    public function __construct(TemperatureRepositoryInterface $temperature_repository, CityRepositoryInterface $city_repository) {
        $this->middleware('auth');
        $this->temperature_repository = $temperature_repository;
        $this->city_repository = $city_repository;
    }
    
    public function getTemperature() {
        $api_key = config('openweather.api_key');
        $city1 = config('openweather.city1');
        $city2 = config('openweather.city2');

        $response_city1_celcius = Http::get('https://api.openweathermap.org/data/2.5/weather?q='.$city1.'&appid='.$api_key.'&units=metric');
        $response_city1_farenheit = Http::get('https://api.openweathermap.org/data/2.5/weather?q='.$city1.'&appid='.$api_key.'&units=imperial');
        $response_city2_celcius = Http::get('https://api.openweathermap.org/data/2.5/weather?q='.$city2.'&appid='.$api_key.'&units=metric');
        $response_city2_farenheit = Http::get('https://api.openweathermap.org/data/2.5/weather?q='.$city2.'&appid='.$api_key.'&units=imperial');

        $city1 = $this->city_repository->find(1);
        $city2 = $this->city_repository->find(2);
        
        $json_decoded_response_city1_celcius = json_decode($response_city1_celcius);
        $json_decoded_response_city1_farenheit = json_decode($response_city1_farenheit);
        $json_decoded_response_city2_celcius = json_decode($response_city2_celcius);
        $json_decoded_response_city2_farenheit = json_decode($response_city2_farenheit);
        
        $this->temperature_repository->create([
            'city_id' => $city1->id,
            'user_id' => Auth::id(),
            'celcius' => $json_decoded_response_city1_celcius->main->temp,
            'fahrenheit' => $json_decoded_response_city1_farenheit->main->temp
        ]);
        $this->temperature_repository->create([
            'city_id' => $city2->id,
            'user_id' => Auth::id(),
            'celcius' => $json_decoded_response_city2_celcius->main->temp,
            'fahrenheit' => $json_decoded_response_city2_farenheit->main->temp
        ]);

        return Inertia::render('Dashboard');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;
use App\AddCityForm;
use Illuminate\Support\Facades\DB;

class WeatherController extends Controller
{
    private $apiWeatherURL = "http://api.openweathermap.org/data/2.5/weather?q=";
    private $apiForecastURL = "http://api.openweathermap.org/data/2.5/forecast?q=";
    private $apiKey = "&APPID=ea231eb59e361976d31ab63e94aa3fe4";
    
    public function cityExist($cityName){ 
        if( @file_get_contents($this->apiWeatherURL.$cityName.$this->apiKey) ){
            return 1;
        }
        return 0;
    }

    public function save(Request $request){   
        $model = new City;
        $city = $model::where('name', $request->city)->get();
        if( $this->cityExist($request->city) == 1 && !count($city)){
            
            $model->name = $request->city;
            if($model->save()){
                return 1;
            }
        }
        return 0;
    }

    public function index(){
        $model = new City();
        $cityList = $model::all();    
        return view('welcome', ['cityList' => $cityList]);
    }

    public function showCity($city){

        $weatherData = json_decode(file_get_contents($this->apiWeatherURL.$city.$this->apiKey), true);
        return view('show', ['weather' => $weatherData, 'cityName' => $city]);
    }

    public function chartData(Request $request){

        $forecastData = json_decode(file_get_contents($this->apiForecastURL.$request->city.$this->apiKey), true);

        $forecastList = $forecastData['list'];
        $timeArr = [];
        $tempArr =[];
        $rainArr = [];

        for( $i=0; $i<10; $i++ ){
            $timeArr[$i] = date('H:i ',$forecastList[$i]['dt']);
            $tempArr[$i] = floor($forecastList[$i]['main']['temp'] - 273.15);
            if(array_key_exists('rain', $forecastList[$i])){
                if(array_key_exists('3h', $forecastList[$i]['rain'])){
                    $rain = $forecastList[$i]['rain']['3h'];
                    $rainArr[$i] = floor($rain*10+0.5)/10;
                }else{
                    $rainArr[$i] = '0';
                }        
            }else{
                $rainArr[$i] = '0';
            }        
        }

        $response = array(
            'time' => $timeArr,
            'temp' => $tempArr,
            'rain' => $rainArr,
        );
        return response()->json($response); 

    }

    public function delete(Request $request){

        if(DB::table('city')->where('name', '=', $request->city)->delete()){
                return 1;
        }else{
            return 0;
        }

        
    }
    
   
}

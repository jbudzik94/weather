<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
       
        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <!-- Chart -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <!-- Styles -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet" type="text/css" >
    </head>
    <body >
    <div class="container-fluid" >
       
            <div  class="row justify-content-md-center top-gap"> 
                <div class="col-lg-7 small-top-gap" >
                    <div id="weatherFor"></div>
                    <div id="temperature"></div>
                </div>
            </div>    
        


            <div class="row justify-content-md-center top-gap"> 
                <div class="col-lg-2 small-top-gap">
                   
                    <div id="widgetWeather">
                        <table class="table-sm table-striped table-bordered">
                            <div class ="invisible" id="cityName">{{$cityName}}</div>
                            <tbody>
                                <tr>
                                    <td>{{__('message.wind')}}</td>
                                    <td>{{$weather['wind']['speed']}} m/s</td>
                                </tr>
                                <tr>
                                    <td>{{__('message.cloudy')}}</td>
                                    <td>{{$weather['clouds']['all']}}</td>
                                </tr>
                                <tr>
                                    <td>{{__('message.pressure')}}</td>
                                    <td>{{$weather['main']['pressure']}} hpa</td>
                                </tr>
                                <tr>
                                    <td>{{__('message.humidity')}}</td>
                                    <td>{{$weather['main']['humidity']}} %</td>
                                </tr>
                                <tr>
                                    <td>{{__('message.sunrise')}}</td>
                                    <td>{{date('H:i',$weather['sys']['sunrise'])}}</td>
                                </tr>
                                <tr>
                                    <td>{{__('message.sunset')}}</td>
                                    <td>{{date('H:i',$weather['sys']['sunset'])}}</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-lg-5 text-center">
                    <canvas id="mixed-chart" width="700" height="400"></canvas>               
                </div>
            </div>
       
    </div>

        
    </body>
</html>
<script type="text/javascript" src="{{ asset('js/chart.js') }}"></script>

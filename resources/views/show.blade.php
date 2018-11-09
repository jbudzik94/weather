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
    <style>
        html,body{
            height: 100%;
        }
    </style>
    </head>
    <body >
    <div class="container-fluid" style=" width: 100%; background-color: white; padding: 0 0 0 0;" >
       
            <div class="row justify-content-md-center" style="padding-top: 100px;"> 
                <div class="col-lg-7" style="padding-top: 10px;">
                    <div id="weatherFor"  style="font-size: 35px;"></div>
                    <div id="temperature" style="padding-bottom: 10px; font-size: 20px;"></div>
                </div>
            </div>    
        


            <div class="row justify-content-md-center" style="padding-top: 70px;"> 
                <div class="col-lg-2" style="padding-top: 10px;">
                   
                    <div id="widgetWeather">
                        <table class="table-sm table-striped table-bordered">
                            <div class ="invisible" id="cityName">{{$cityName}}</div>
                            <tbody>
                                <tr>
                                    <td>Wiatr</td>
                                    <td>{{$weather['wind']['speed']}} m/s</td>
                                </tr>
                                <tr>
                                    <td>Zachmurzenie</td>
                                    <td>{{$weather['clouds']['all']}}</td>
                                </tr>
                                <tr>
                                    <td>Ciśnienie</td>
                                    <td>{{$weather['main']['pressure']}} hpa</td>
                                </tr>
                                <tr>
                                    <td>Wilgotność</td>
                                    <td>{{$weather['main']['humidity']}} %</td>
                                </tr>
                                <tr>
                                    <td>Wschód słońca</td>
                                    <td>{{date('H:i',$weather['sys']['sunrise'])}}</td>
                                </tr>
                                <tr>
                                    <td>Zachód słońca</td>
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
<script>
(function(){

        var cityName = document.getElementById('cityName').innerHTML;
        console.log(cityName);
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        $.ajax({
                    type:'POST',
                    url:"weather/"+{city: cityName},
                    data:{city: cityName},
                    success:function(data){
                       // widgetWeather.innerHTML = data.html;
                        weatherFor.innerHTML = "Pogoda dla " + cityName;
                        temperature.innerHTML = data.temp[0] + " &#x2103";

                        if(Chart == undefined){
                            console.log("chart is undefined");
                        }else{
                            console.log("chart is defined");
                        }
                        var chart = new Chart(document.getElementById("mixed-chart"), {
                            type: 'bar',
                            data: {
                                labels: data.time,
                                datasets: [{
                                    label: "Temperatura",
                                    type: "line",
                                    borderColor: "#8e5ea2",
                                    data: data.temp,
                                    yAxisID: 'right-y-axis',
                                    fill: false
                                    }, {
                                    label: "Opady",
                                    type: "bar",
                                    backgroundColor: "rgba(0,0,0,0.2)",
                                    backgroundColorHover: "#3e95cd",
                                    data: data.rain,
                                    yAxisID: 'left-y-axis'
    
                                    }
                                ]
                            },
                            options: {

                                scales: {
                                    yAxes: [{
                                        id: 'left-y-axis',
                                        type: 'linear',
                                        position: 'left',
                                        scaleLabel: {
                                            display: true,
                                            labelString: 'opady'
                                        }
                                    }, {
                                        id: 'right-y-axis',
                                        type: 'linear',
                                        position: 'right',
                                        scaleLabel: {
                                            display: true,
                                            labelString: 'temperatura',
                                        }
                                    }]
                                },

                            legend: { display: true,}
                            }
                        });
                        
                        
                    }
                });
})();
</script>
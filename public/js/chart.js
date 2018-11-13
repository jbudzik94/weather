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
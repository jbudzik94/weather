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
<!--------------------->
        <div class="row-fluid"><!-- style="width: 100%; background-color: red;"-->
            <div class="col-lg-12 text-center">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5" >
                            <h1 class="mt-5">Sprawdz pogodę!</h1>
                            <h5>Podaj nazwę miasta<h5>


                        </div>
                    </div>

                    <div class="row justify-content-center" style="height: 140px; padding-top: 30px; ">
                        <div class="col-lg-5">
                            <div class="form-inline justify-content-center">
                                <div class="form-group  mb-2">
                                    <input class="form-control" id="cityName" type="text" name="city">
                                </div>
                                <button class="btn btn-primary mb-2" id="addCityBtn" type="submit" name="submit">Dodaj miasto</button>
                            </div>
                            <div class="error" style="font-size: 13px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<!----------------->
        <div class="row justify-content-center">
            <div class="col-lg-2 ">
                <div  class="city-list ">
                    <ul id="cityList">
                        <?php 
                        foreach($cityList as $city){
                            echo '<li><a href="'.$city->name.'"  >'.$city->name.'</a>';
                            echo '<button id="'. $city->name .'" type="button" align="center" class="close" aria-label="Close >';
                            echo '<span aria-hidden="true">&times;</span>';
                            echo "</button></li>";
                           // echo "<button onclick='myFunction()' >Click me</button>";
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>  
    </div>
        
    </body>
</html>

<script>
(function(){
    $.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var cityList =  document.getElementById("cityList")
    var cityName = document.getElementById("cityName");
    var error = document.getElementsByClassName("error")[0];


    var elements = document.querySelectorAll(".close");
    for (var i = 0; i < elements.length; i++) {
        elements[i].addEventListener("click", function() {
            console.log("clicked");
            console.log(this.parentElement.nodeName);
            console.log(this.id);
            var city = this.id;
            var parentElement = this.parentElement;
            $.ajax({
                type:'POST',
                url:'delete',
                data:{city: city},
                success:function(data){
                    console.log("delete " + data);
                    parentElement.remove();
                }
            });
        }); 
    }

    document.getElementById("addCityBtn").addEventListener("click", function(){
        if(cityName.value === ""){ //is empty
            error.innerHTML="";
            console.log("input is empty");
            var errorNode   = document.createTextNode("Wpisz nazwę miasta");
            error.appendChild(errorNode);
        }else{
            error.innerHTML="";
            var button = document.createElement("button");
            var link = document.createElement("a");
         

            $.ajax({
                type:'POST',
                url:'save',
                data:{city: cityName.value},
                success:function(data){
                    if(data == 1){
                        error.innerHTML="";
                        var para   = document.createElement("li");
                        link.href = cityName.value
                        button.style.margin = "0 10px 0 10px";
                        var node   = document.createTextNode(cityName.value);
                        link.appendChild(node);
                        para.appendChild(link);
                        
                        var button2 = document.createElement("button");
                        button2.setAttribute("class", "close");
                        var span = document.createElement("span");
                        span.setAttribute("aria-hidden", "true");
                        var node2   = document.createTextNode("×");
                        span.appendChild(node2);
                        button2.appendChild(span);
                        para.appendChild(button2);

                        cityList.appendChild(para);
                        var city =  cityName.value;
                        cityName.value = "";
                        
                        button2.addEventListener("click", function(){
                            var parentElement = button2.parentElement;
                            $.ajax({
                                type:'POST',
                                url:'delete',
                                data:{city: city},
                                success:function(data){
                                    console.log("delete " + data);
                                    parentElement.remove();
                                }
                            });
                        });

                    }else{
                        var errorNode   = document.createTextNode("Podana nazwa jest nieprawidłowa");
                        error.appendChild(errorNode);
                    }
                }
            });

        }     //end else   
    }); 
    


})();

</script>


<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
       

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <!-- This token is nessesary to send data via ajax using post method -->
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <!-- Styles -->
        
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet" type="text/css" >
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
 
    </head>
    <body >
    <div class="container-fluid" >
<!--------------------->
        <div class="row-fluid">
            <div class="col-lg-12 text-center">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5" >
                            <h1 class="mt-5">{{__('message.header_msg')}}</h1>
                            <h5>{{__('message.input_city')}}<h5>
                        </div>
                    </div>

                    <div id="form" class="row justify-content-center" >
                        <div class="col-lg-5">
                            <div class="form-inline justify-content-center">
                                <div class="form-group  mb-2">
                                    <input class="form-control" id="cityName" type="text" name="city">
                                </div>
                                <button class="btn btn-primary mb-2" id="addCityBtn" type="submit" name="submit">{{__('message.btn_add')}}</button>
                            </div>
                            <div class="error"></div>
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
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>  
    </div>
        
    </body>
</html>
<script type="text/javascript" src="{{ asset('js/mainPage.js') }}"></script>


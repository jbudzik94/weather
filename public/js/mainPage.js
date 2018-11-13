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
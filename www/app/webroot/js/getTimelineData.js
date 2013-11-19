$(document).ready(function(){
    
    function getInteractionData(){
        
        var request = 
        $.ajax(window.location.origin + "/graphs/getInteractionData/",
        {
            type: "POST",
            data: {},
            dataType: "JSON"
        });
        request.done(function(data){					
            for (var key in data.history){          		
                for(var x in key){          			
                    console.log(key + " -> " + key[x]);        
                    console.log(x);
                }			
            }
            console.log(data.history);
        });     
    }
   getInteractionData();
});/*var myArray = JSON.parse(data);                        for (var i = 0; i < myArray.length; i++) {			    alert(myArray[i].Title);			}*/            			/*for (var i = 0; i < data.values; i++) {			    var object = data[i];			    for (var property in object) {			        console.log('item ' + i + ': ' + property + '=' + object[property]);			    }			}*/						/*for (var key in data) {				console.log(key);			}						for (var key in data) {  				if (data.hasOwnProperty(key)) {    				console.log(key);  				}			}*/			    			/*console.log(data.history);            var result = data.filter(function(data){			    if (data.history == object){			        console.log(data.history);			    } else {			        alert("wrong");			    }			});*/						/*console.log(data.history);*/


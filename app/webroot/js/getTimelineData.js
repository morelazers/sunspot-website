 
    function getInteractionData(){
        
        var request = $.ajax(window.location.origin + "/graphs/getInteractionData/",
        {
            type: "GET",
            dataType: "JSON"
        });
        request.done(function(data){
			var vals = data.interactionsReadings;
			console.log(vals);
			var i = 0;
			var white = 0;
			var door = 0;
			var fridge = 0;
			for(i = 0; i < vals.length; i++){
				if((vals[i]['InteractionData']['object_name']) == "whiteboard"){
					$('#W1').html(white+1);
				}
				if((vals[i]['InteractionData']['object_name']) == "fridge"){
					$('#F1').html(fridge+1);
				}
				if((vals[i]['InteractionData']['object_name']) == "door"){
					$('#D1').html(door+1);
				}
			}
        });     
   }
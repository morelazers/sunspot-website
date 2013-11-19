$(document).ready(function(){

    function getPastMovementData(days){
    	var request = 
        $.ajax(window.location.origin + "/graphs/getHourlyMovementData/",
        {
            type: "POST",
            data: {daysToGoBack: days},
            dataType: "JSON"
        });

        request.done(function(data){
        	console.log(zone1Vals);
        	console.log(zone2Vals);
        	console.log(zone3Vals);
        });
    }

    getPastMovementData(1);

});
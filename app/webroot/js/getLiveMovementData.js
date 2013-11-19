$(document).ready(function(){
	var date = new Date();
	var time = date.getTime();
});
	
function getLiveMovement() {
  
	var request = 
    $.ajax(window.location.origin + "/graphs/getLiveMovementData/",
    {
        type: "POST",
        dataType: "JSON"
    });
    request.done(function(data){
    	console.log(data.zone);
    	console.log(data.spotAddr);
    	console.log(data.timestamp);

    	/* NEW MOVEMENT DISPLAY CODE */
    
    
      /* NEW MOVEMENT DISPLAY CODE */
      
      
    	var labZone =  $(".zone-" + data.zone);
    	var userCount = labZone.length;
    	var moveTo = $(".zone-" + data.zone).position();
    	var userDiv = $("#user-addr-" + data.spotAddr);
    	userDiv.animate({
    		top: moveTo.top,
    		left: moveTo.left
    	});
    });
}


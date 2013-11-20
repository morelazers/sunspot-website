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
    	//console.log(data.zone);
    	//console.log(data.spotAddr);
    	//console.log(data.timestamp);
		
  		//console.log("Users: " + $("#user-" + data.spotAddr).length);
  		
  		var spotId = data.spotAddr.toString();
  		
  		spotId = spotId.replace(/\./g, "\\.");
  		
  		//console.log(spotId);
  		
  		var exists = $("#user-" + spotId).length;
  		
  		//console.log("#user-" + spotId);
  		
  		if(exists === 0){
  			//console.log("Appending");
  			$("#live-user-location-zones").append("<div id='user-" + data.spotAddr + "' class='live-user-location zone-1'></div>");
  		}

    	/* NEW MOVEMENT DISPLAY CODE */
    
		  newZone = data.zone;

    	/* find out which zone the user was in previously so we can resize the other elements */
    	oldZone = parseInt($("#user-" + spotId).attr('class').slice(24));

    	console.log("Spot " + spotId + " moved from " + oldZone + " to " + newZone);

    	/* add the zone class to the user div */
    	$("#user-" + spotId).removeClass (function (index, css) {
		    return (css.match (/\bzone-\S+/g) || []).join(' ');
		  });

        $("#user-" + spotId).addClass("zone-" + newZone);

        /* find the number of users in the old and new zones */
        var usersInOldZone = $(".zone-" + oldZone).length - 1;
        var usersInNewZone = $(".zone-" + newZone).length - 1;


    		/*console.log(usersInOldZone);
        console.log(usersInNewZone);*/
		oldMove = $("#zone-" + oldZone).position();
        oldHeight = parseInt($("#zone-" + oldZone).css('height')) / usersInOldZone;
        otherUsersInOldZone = $(".live-user-location.zone-" + oldZone);
        otherUsersInOldZone.animate({
			"margin-top" : oldMove.top + (oldHeight * (usersInOldZone - 1)) - oldMove.top + 1,
        	height: oldHeight
        });

        /* get the new height of the div by dividing by the number of users in the zone */
    	newHeight = parseInt($("#zone-" + newZone).css('height')) / usersInNewZone;
    	newWidth = $("#zone-" + newZone).css('width');

    	//console.log(newHeight);

        move = $("#zone-" + newZone).position();
        console.log("top: " + move.top + (newHeight * (usersInNewZone - 1)));
        console.log("left: " + move.left);
        $("#user-" + spotId).animate({
            "margin-top": move.top + (newHeight * (usersInNewZone - 1)) - move.top + 2,
            left: move.left + 2,
            width: newWidth,
            height: newHeight
        });

        otherusersInNewZone = $(".live-user-location.zone-" + newZone);

        //console.log(otherusersInNewZone.length);
        otherusersInNewZone.animate({
        	height: newHeight
        });
	
    
      /* NEW MOVEMENT DISPLAY CODE */
      
      
    	//var labZone =  $("#zone-" + data.zone);
    	//var userCount = labZone.length;
    	//var moveTo = labZone.position();
    	//var userDiv = $("#user-" + spotId);
    	/*
		userDiv.animate({
    		top: moveTo.top,
    		left: moveTo.left
    	});
		*/
    });
}


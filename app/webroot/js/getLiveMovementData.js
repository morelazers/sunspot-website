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
		
		console.log("Users: " + $("#user-" + data.spotAddr).length);
		
		var spotId = data.spotAddr.toString();
		
		spotId = spotId.replace(/\./g, "\\.");
		
		console.log(spotId);
		
		var exists = $("#user-" + spotId).length;
		
		console.log("#user-" + spotId);
		
		if(exists === 0){
			console.log("Appending");
			$("#live-user-location-zones").append("<div id='user-" + data.spotAddr + "' class='live-user-location zone-1'></div>");
		}

    	/* NEW MOVEMENT DISPLAY CODE */
    
		newZone = data.zone;

    	console.log(newZone);

    	/* find out which zone the user was in previously so we can resize the other elements */
    	oldZone = parseInt($("#user-" + spotId).attr('class').slice(24));

    	console.log(oldZone);

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

        oldHeight = parseInt($("#zone-" + oldZone).css('height')) / usersInOldZone;
        otherUsersInOldZone = $(".live-user-location.zone-" + oldZone);
        otherUsersInOldZone.animate({
        	height: oldHeight
        });

        /* get the new height of the div by dividing by the number of users in the zone */
    	newHeight = parseInt($("#zone-" + newZone).css('height')) / usersInNewZone;
    	newWidth = $("#zone-" + newZone).css('width');

    	//console.log(newHeight);

        move = $("#zone-" + newZone).position();
        console.log(move.top + (newHeight * (usersInNewZone - 1)));
        $("#user-" + spotId).animate({
            top: move.top + (newHeight * (usersInNewZone -1 )),
            left: move.left,
            width: newWidth,
            height: newHeight
        });

        otherusersInNewZone = $(".live-user-location.zone-" + newZone);

        //console.log(otherusersInNewZone.length);

        otherusersInNewZone.animate({
        	height: newHeight
        });
	
    
      /* NEW MOVEMENT DISPLAY CODE */
      
      
    	var labZone =  $(".zone-" + data.zone);
    	var userCount = labZone.length;
    	var moveTo = $(".zone-" + data.zone).position();
    	var userDiv = $("#user-" + spotId);
    	userDiv.animate({
    		top: moveTo.top,
    		left: moveTo.left
    	});
    });
}


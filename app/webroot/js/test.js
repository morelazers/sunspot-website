$(document).ready(function(){

    $(".lab-zone").click(function () {

    	newZone = $(this).attr('id').slice(5);

    	/*console.log(newZone);*/

    	/* find out which zone the user was in previously so we can resize the other elements */
    	oldZone = parseInt($("#user-test").attr('class').slice(24));

    	//console.log(oldZone);

    	/* add the zone class to the user div */
    	$("#user-test").removeClass (function (index, css) {
		    return (css.match (/\bzone-\S+/g) || []).join(' ');
		});

        $("#user-test").addClass("zone-" + newZone);

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
    	newHeight = parseInt($(this).css('height')) / usersInNewZone;
    	newWidth = $(this).css('width');

    	//console.log(newHeight);

        move = $(this).position();
        console.log(move.top + (newHeight * (usersInNewZone - 1)));
        $('#user-test').animate({
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

    });
});
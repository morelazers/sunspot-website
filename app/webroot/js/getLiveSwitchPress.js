var colours = [
	"rgba(255, 0, 0, 0.5)",
	"rgba(0, 255, 0, 0.5)",
	"rgba(0, 0, 255, 0.5)",
	"rgba(255, 255, 0, 0.5)",
	"rgba(0, 255, 255, 0.5)",
	"rgba(255, 0, 255, 0.5)",
	"rgba(128, 0, 0, 0.5)",
	"rgba(0, 128, 0, 0.5)",
	"rgba(128, 0, 128, 0.5)",
	"rgba(128, 128, 0, 0.5)",
	"rgba(0, 128, 128, 0.5)",
	"rgba(0, 0, 128, 0.5)"
];

function getLiveSwitchPress() {
  
	var request = 
    $.ajax(window.location.origin + "/graphs/getLiveSwitchPress/",
    {
        type: "POST",
        dataType: "JSON"
    });
    request.done(function(data){
    	console.log(data.spotAddr + " requested a colour change to " + $.trim(colours[data.colourId]));
		
		var spotId = data.spotAddr.toString();
		
		spotId = spotId.replace(/\./g, "\\.");
		
		console.log(spotId);
		
		var spot = $("#user-" + spotId);
		
		
		
		console.log(spot.css('background-image'));
		
		console.log('repeating-linear-gradient(45deg, '+ colours[data.colourId] +' 0px, '+ colours[data.colourId] +' 25px, transparent 25px, transparent 50px, transparent 50px)');
		
    	$("#user-" + spotId).fadeTo(500, 0.5, function(){
			$("#user-" + spotId).css('background-image',
				'repeating-linear-gradient(45deg, '+ colours[data.colourId] +' 0px, '+ colours[data.colourId] +' 25px, transparent 25px, transparent 50px, transparent 50px)'
			).fadeTo(500, 1);
		});
    	$("#switch-colour-box").css('background-color', $.trim(colours[data.colourId]));
    });
    
}


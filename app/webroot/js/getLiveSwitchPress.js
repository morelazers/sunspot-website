var colours = [
	"#ff0000",
	"#00FF00",
	"#0000FF",
	"#FFFF00",
	"#00FFFF",
	"#FF00FF",
	"#800000",
	"#008000",
	"#800080",
	"#808000",
	"#008080",
	"#000080"
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


$(document).ready(function(){
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
});


function getLiveSwitchPress() {
  
	var request = 
    $.ajax(window.location.origin + "/graphs/getLiveSwitchPress/",
    {
        type: "POST",
        dataType: "JSON"
    });
    request.done(function(data){
    	console.log(data.spotAddr + " requested a colour change to " + $.trim(colours[data.colourId]));
    	$("#user-" + data.spotAddr).css('background-image',
    	  'repeating-linear-gradient(45deg, '+data.colourId+' 0px, '+data.colourId+' 25px, transparent 25px, transparent 50px, transparent 50px)');
    	$("#switch-colour-box").css('background-color', $.trim(colours[data.colourId]));
    });
    
}


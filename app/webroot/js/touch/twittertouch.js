function getLiveTweets(){
	var request = 
    $.ajax(window.location.origin + "/twitter/getAllTweets/",
    {
        type: "POST",
        dataType: "JSON"
    });
    request.done(function(data){
    	console.log(data);
    	data.forEach(function(entry){
    		setTimeout(changeTweet(entry.user.name, entry.text), 5000);
    		/*$("#twitter-scrolling-name").text(entry.user.name);
    		$("#twitter-scrolling-body").text(entry.text);*/
    		//console.log(entry);
    		/*console.log(entry.user.name);
    		console.log(entry.entities.text);*/
    	});
    });
}



function changeTweet(name, content){
	$("#twitter-scrolling-name").text(entry.user.name);
	$("#twitter-scrolling-body").text(entry.text);
}
function getLiveInteractionData(){
	var request = 
  $.ajax(window.location.origin + "/graphs/getLiveInteractionData/",
  {
      type: "POST",
      dataType: "JSON"
  });
  request.done(function(data){
    //data will come back in data.interactions
    console.log(data.interactions);
  });
}
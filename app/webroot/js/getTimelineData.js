 
    function getInteractionData(){
        
      var request = $.ajax(window.location.origin + "/graphs/getInteractionData/",
      {
          type: "GET",
          dataType: "JSON"
      });
      request.done(function(data){
        var vals = data.interactionsReadings;
		document.getElementById("door_Img").src="../app/webroot/img/door_wid.png";
		document.getElementById("fridge_Img").src="../app/webroot/img/fridge_wid.png";
		document.getElementById("whiteboard_Img").src="../app/webroot/img/whiteboard_wid.png";
		for(i = 0; i < vals.length; i++){
			if((vals[i]['InteractionData']['object_name']) == "door" || (vals[i]['InteractionData']['object_name']) == "Door"){
				
			}
			if((vals[i]['InteractionData']['object_name']) == "door" || (vals[i]['InteractionData']['object_name']) == "Door"){
				$('#fridge_txt').html(vals[i]['InteractionData']['timestamp']);
			}
			if((vals[i]['InteractionData']['object_name']) == "door" || (vals[i]['InteractionData']['object_name']) == "Door"){
				$('#whiteboard_txt').html(vals[i]['InteractionData']['timestamp']);
			}
		}
      });
   }
   
function getDoorData(){
        
    var request = $.ajax(window.location.origin + "/graphs/getInteractionData/",
    {
        type: "GET",
        dataType: "JSON"
    });
    request.done(function(data){
        var vals = data.interactionsReadings;
        var i = 0;
		for(i = 0; i < vals.length; i++){
			if((vals[i]['InteractionData']['object_name']) == "door" || (vals[i]['InteractionData']['object_name']) == "Door"){		
				document.getElementById("door_Img").src="../app/webroot/img/door_wid_glow.png";
			}
		}
	});
}

function getFridgeData(){
        
    var request = $.ajax(window.location.origin + "/graphs/getInteractionData/",
    {
        type: "GET",
        dataType: "JSON"
    });
    request.done(function(data){
        var vals = data.interactionsReadings;
        var i = 0;
		for(i = 0; i < vals.length; i++){
			if((vals[i]['InteractionData']['object_name']) == "fridge" || (vals[i]['InteractionData']['object_name']) == "Fridge"){
				document.getElementById("fridge_Img").src="../app/webroot/img/fridge_wid_glow.png";
			}
		}
	});
}
function getWhiteboardData(){
        
    var request = $.ajax(window.location.origin + "/graphs/getInteractionData/",
    {
        type: "GET",
        dataType: "JSON"
    });
    request.done(function(data){
        var vals = data.interactionsReadings;
        var i = 0;
		for(i = 0; i < vals.length; i++){
			if((vals[i]['InteractionData']['object_name']) == "whiteboard" || (vals[i]['InteractionData']['object_name']) == "Whiteboard"){
				document.getElementById("whiteboard_Img").src="../app/webroot/img/whiteboard_wid_glow.png";
			}
		}
	});
}
function getLastInteractionTime(){
        
    var request = $.ajax(window.location.origin + "/graphs/getLastInteractionTime/",
    {
        type: "GET",
        dataType: "JSON"
    });
    request.done(function(data){
        var vals = data;
        var i = 0;
		$('#door_txt').html(vals['doortime']['0']);
		$('#fridge_txt').html(vals['fridgetime']['0']);
		$('#whiteboard_txt').html(vals['whiteboardtime']['0']);
	});
}

   
$(document).ready(function(){
  $("#interaction-item-select").change(function(){
    var selectedOpt = $("#interaction-item-select option:selected").text();
    getItemInteractionData(selectedOpt.toLowerCase(), 0);
  });  
});

function getItemInteractionData(name, months){
  $(".interaction-item").hide();
  $("#stats-interaction-" + name).show();
  
  var request = $.ajax(window.location.origin + "/graphs/getAllInteractionData/",
  {
      type: "POST",
      dataType: "JSON",
      data:
      {
        itemName: name,
        monthsToGoBack: months
      }
  });
  request.done(function(data){
    drawInteractionChart(name, data.response);
  });
}

function drawInteractionChart(itemName, jsonResponse){
  console.log(jsonResponse);
}
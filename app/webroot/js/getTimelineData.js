 
    function getInteractionData(){
        
      var request = $.ajax(window.location.origin + "/graphs/getInteractionData/",
      {
          type: "GET",
          dataType: "JSON"
      });
      request.done(function(data){
        var vals = data.interactionsReadings;
        var i = 0;
        for(i = 0; i < vals.length; i++){
        	if((vals[i]['InteractionData']['object_name']) == "door"){
				document.getElementById("touch_fridge_Img").src="../app/webroot/img/fridge_wid.png";
				document.getElementById("touch_whiteboard_Img").src="../app/webroot/img/whiteboard_wid.png";
				document.getElementById("fridge_Img").src="../app/webroot/img/fridge_wid.png";
				document.getElementById("whiteboard_Img").src="../app/webroot/img/whiteboard_wid.png";
				
				document.getElementById("touch_door_Img").src="../app/webroot/img/door_wid_glow.png";
				document.getElementById("door_Img").src="../app/webroot/img/door_wid_glow.png";
        	}
        	if((vals[i]['InteractionData']['object_name']) == "fridge"){
				document.getElementById("touch_whiteboard_Img").src="../app/webroot/img/whiteboard_wid.png";
        		document.getElementById("touch_door_Img").src="../app/webroot/img/door_wid.png";
				document.getElementById("whiteboard_Img").src="../app/webroot/img/whiteboard_wid.png";
				document.getElementById("door_Img").src="../app/webroot/img/door_wid.png";
				
				document.getElementById("touch_fridge_Img").src="../app/webroot/img/fridge_wid_glow.png";
				document.getElementById("fridge_Img").src="../app/webroot/img/fridge_wid_glow.png";
        	}
        	if((vals[i]['InteractionData']['object_name']) == "whiteboard"){
				document.getElementById("door_Img").src="../app/webroot/img/door_wid.png";
				document.getElementById("fridge_Img").src="../app/webroot/img/fridge_wid.png";
				document.getElementById("touch_door_Img").src="../app/webroot/img/door_wid.png";
				document.getElementById("touch_fridge_Img").src="../app/webroot/img/fridge_wid.png";
				
				document.getElementById("touch_whiteboard_Img").src="../app/webroot/img/whiteboard_wid_glow.png";
				document.getElementById("whiteboard_Img").src="../app/webroot/img/whiteboard_wid_glow.png";
        	}
        }
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
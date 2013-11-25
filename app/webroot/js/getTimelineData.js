 
    function getInteractionData(){
        
      var request = $.ajax(window.location.origin + "/graphs/getInteractionData/",
      {
          type: "GET",
          dataType: "JSON"
      });
      request.done(function(data){
        var vals = data.interactionsReadings;
        console.log(vals);
        var i = 0;
        var white = 0;
        var door = 0;
        var fridge = 0;
        for(i = 0; i < vals.length; i++){
        	if((vals[i]['InteractionData']['object_name']) == "whiteboard"){
        		$('#W1').html(white+1);
        	}
        	if((vals[i]['InteractionData']['object_name']) == "fridge"){
        		$('#F1').html(fridge+1);
        	}
        	if((vals[i]['InteractionData']['object_name']) == "door"){
        		$('#D1').html(door+1);
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
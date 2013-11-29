	
	function getActuatorData(){
			
		  var request = $.ajax(window.location.origin + "/graphs/getActuatorData/",
		  {
			  type: "GET",
			  dataType: "JSON"
		  });
		  request.done(function(data){
		  	var name = "";
		  	var status = "";
			var vals = data.vals;
			var i = 0;
			for(i = 0; i < vals.length; i++){
				name = vals[i]['Actuators']['actuator_name'];
				status = vals[i]['Actuators']['actuator_status'];
				if((name.toString() == "minifridge") && (status.toString() == "true")){
					document.getElementById("mini_fridge_Img").src="../app/webroot/img/usb_fridge_glow.png";
				}
				if((name.toString() == "fan") && (status.toString() == "true")){
					document.getElementById("fan_Img").src="../app/webroot/img/usb_fan_glow.png";
				}
				if((name.toString() == "fan") && (status.toString() == "true")){
					document.getElementById("glove_Img").src="../app/webroot/img/usb_gloves_glow.png";
				}
				if((name.toString() == "minifridge") && (status.toString() == "false")){
					document.getElementById("mini_fridge_Img").src="../app/webroot/img/usb_fridge.png";
				}
				if((name.toString() == "fan") && (status.toString() == "false")){
					document.getElementById("fan_Img").src="../app/webroot/img/usb_fan.png";
				}
				if((name.toString() == "gloves") && (status.toString() == "false")){
					document.getElementById("glove_Img").src="../app/webroot/img/usb_gloves.png";
				}
			}
		  });     
	}
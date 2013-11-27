	
	function getActuatorData(){
			
		  var request = $.ajax(window.location.origin + "/graphs/getActuatorData/",
		  {
			  type: "GET",
			  dataType: "JSON"
		  });
		  request.done(function(data){
			var vals = data.actuatorReadings;
			var i = 0;
			for(i = 0; i < vals.length; i++){
				if((vals[i]['Actuators']['actuator_name']) == "minifridge"){
					if((vals[i]['Actuators']['actuator_status']) = "true"){
						document.getElementById("glove_Img").src="../app/webroot/img/usb_gloves.png";
						document.getElementById("fan_Img").src="../app/webroot/img/usb_fan.png";
						document.getElementById("mini_fridge_Img").src="../app/webroot/img/usb_fridge_glow.png";
					}
				}
				if((vals[i]['Actuators']['actuator_name']) == "fan"){
					if((vals[i]['Actuators']['actuator_status']) = "true"){
						document.getElementById("mini_fridge_Img").src="../app/webroot/img/usb_fridge.png";
						document.getElementById("glove_Img").src="../app/webroot/img/usb_gloves.png";
						document.getElementById("fan_Img").src="../app/webroot/img/usb_fan_glow.png";
					}
				}
				if((vals[i]['Actuators']['actuator_name']) == "gloves"){
					if((vals[i]['Actuators']['actuator_status']) = "true"){
						document.getElementById("mini_fridge_Img").src="../app/webroot/img/usb_fridge.png";
						document.getElementById("fan_Img").src="../app/webroot/img/usb_fan.png";
						document.getElementById("glove_Img").src="../app/webroot/img/usb_gloves_glow.png";
					}
				}
			}
		  });     
	}
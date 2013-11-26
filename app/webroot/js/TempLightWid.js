
		/*
		* LIGHT
		*/
		function getLiveLight(){
			var request = $.ajax(window.location.origin + "/graphs/getLiveLight/",
			{
				type: "GET",
				dataType: "JSON"
			});
				request.done(function(data){
					var vals = data.lightReadings;
					var i = 0;
					for(i = 0; i < vals.length; i++){
						if(parseInt(vals[i]['LightValue']['lab_zone']) == 1){
							var str = vals[x]['LightValue']['reading_value'];
								if(str < 30){
									document.getElementById("oneL_Img").src="../app/webroot/img/bulb_high.png";
								}else if(str > 80){
									document.getElementById("oneL_Img").src="../app/webroot/img/bulb_dim.png";
								}
							$('#L1').html(vals[i]['LightValue']['reading_value']).append("lx");
						}
						if(parseInt(vals[i]['LightValue']['lab_zone']) == 2){
							var str = vals[x]['LightValue']['reading_value'];
								if(str < 30){
									document.getElementById("oneL_Img").src="../app/webroot/img/bulb_high.png";
								}else if(str > 80){
									document.getElementById("oneL_Img").src="../app/webroot/img/bulb_dim.png";
								}
							$('#L2').html(vals[i]['LightValue']['reading_value']).append("lx");
					
						}
						if(parseInt(vals[i]['LightValue']['lab_zone']) == 3){
							var str = vals[x]['LightValue']['reading_value'];
								if(str < 30){
									document.getElementById("oneL_Img").src="../app/webroot/img/bulb_high.png";
								}else if(str > 80){
									document.getElementById("oneL_Img").src="../app/webroot/img/bulb_dim.png";
								}
							$('#L3').html(vals[i]['LightValue']['reading_value']).append("lx");
						}
					}
				});
		}
		
		/*
		*TEMPERATURE
		*/
		function getLiveTemp(){
			var request = $.ajax(window.location.origin + "/graphs/getLiveTemp/",
			{
				type: "GET",	
				dataType: "JSON"
			});
				request.done(function(data){
					var vals = data.tempReadings;
					var x = 0;
					for(x = 0; x < vals.length; x++){
						if(parseInt(vals[x]['TempValue']['lab_zone']) == 1){
							var str = vals[x]['TempValue']['reading_value'];
							var res = str.slice(0,2);
							if(res < 15){
								document.getElementById("oneT_Img").src="../app/webroot/img/temp_cold.png";
							}else if(res > 80){
								document.getElementById("oneT_Img").src="../app/webroot/img/temp_hot.png";
							}
							$('#T1').html(res);
						}
						if(parseInt(vals[x]['TempValue']['lab_zone']) == 2){
							var str = vals[x]['TempValue']['reading_value'];
							var res = str.slice(0,2);
							if(res < 15){
								document.getElementById("twoT_Img").src="../app/webroot/img/temp_cold.png";
							}else if(res > 80){
								document.getElementById("twoT_Img").src="../app/webroot/img/temp_hot.png";
							}
							$('#T2').html(res);
						}
						if(parseInt(vals[x]['TempValue']['lab_zone']) == 3){
							var str = vals[x]['TempValue']['reading_value'];
							var res = str.slice(0,2);
							if(res < 15){
								document.getElementById("threeT_Img").src="../app/webroot/img/temp_cold.png";
							}else if(res > 80){
								document.getElementById("threeT_Img").src="../app/webroot/img/temp_hot.png";
							}
							$('#T3').html(res);
						}
					}
				});
		}
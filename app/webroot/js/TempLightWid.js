
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
							var str = (vals[i]['LightValue']['reading_value']);
							var val = str.concat("lx")
								if(str < 30){
									document.getElementById("oneL_Img").src="../app/webroot/img/bulb_high.png";
									$('#L1').html(val);
								}else if(str > 80){
									document.getElementById("oneL_Img").src="../app/webroot/img/bulb_dim.png";
									$('#L1').html(val);
								}else if(str > 30 || str < 80){
									document.getElementById("oneL_Img").src="../app/webroot/img/bulb_mid.png";
									$('#L1').html(val);
								}
						}
						if(parseInt(vals[i]['LightValue']['lab_zone']) == 2){
							var str = (vals[i]['LightValue']['reading_value']);
							var val = str.concat("lx")
								if(str < 30){
									document.getElementById("twoL_Img").src="../app/webroot/img/bulb_high.png";
									$('#L2').html(val);
								}else if(str > 80){
									document.getElementById("twoL_Img").src="../app/webroot/img/bulb_dim.png";
									$('#L2').html(val);
								}else if(str > 30 || str < 80){
									document.getElementById("twoL_Img").src="../app/webroot/img/bulb_mid.png";
									$('#L2').html(val);
								}
						}
						if(parseInt(vals[i]['LightValue']['lab_zone']) == 3){
							var str = (vals[i]['LightValue']['reading_value']);
							var val = str.concat("lx")
								if(str <= 30){
									document.getElementById("threeL_Img").src="../app/webroot/img/bulb_dim.png";
									$('#L3').html(val);
								}else if(str >= 80){
									document.getElementById("threeL_Img").src="../app/webroot/img/bulb_high.png";
									$('#L3').html(val);
								}else if(str > 30 || str < 80){
									document.getElementById("threeL_Img").src="../app/webroot/img/bulb_mid.png";
									$('#L3').html(val);
								}
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
							if(res < 5){
								document.getElementById("oneT_Img").src="../app/webroot/img/temp_cold.png";
								$('#T1').html(res);
							}else if(res > 30){
								document.getElementById("oneT_Img").src="../app/webroot/img/temp_hot.png";
								$('#T1').html(res);
							}else if(res > 5 || res < 30){
								document.getElementById("oneT_Img").src="../app/webroot/img/temp_mid.png";
								$('#T1').html(res);
							}
						}
						if(parseInt(vals[x]['TempValue']['lab_zone']) == 2){
							var str = vals[x]['TempValue']['reading_value'];
							var res = str.slice(0,2);
							if(res < 5){
								document.getElementById("twoT_Img").src="../app/webroot/img/temp_cold.png";
								$('#T2').html(res);
							}else if(res > 30){
								document.getElementById("twoT_Img").src="../app/webroot/img/temp_hot.png";
								$('#T2').html(res);
							}else if(res > 5 || res < 30){
								document.getElementById("twoT_Img").src="../app/webroot/img/temp_mid.png";
								$('#T2').html(res);
							}
						}
						if(parseInt(vals[x]['TempValue']['lab_zone']) == 3){
							var str = vals[x]['TempValue']['reading_value'];
							var res = str.slice(0,2);
							if(res < 5){
								document.getElementById("threeT_Img").src="../app/webroot/img/temp_cold.png";
								$('#T3').html(res);
							}else if(res > 30){
								document.getElementById("threeT_Img").src="../app/webroot/img/temp_hot.png";
								$('#T3').html(res);
							}else if(res > 5 || res < 30){
								document.getElementById("threeT_Img").src="../app/webroot/img/temp_mid.png";
								$('#T3').html(res);
							}
						}
					}
				});
		}
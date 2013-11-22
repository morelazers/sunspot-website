
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
						if((vals[i]['LightValue']['lab_zone']) == 1){
							$('#L1').html(vals[i]['LightValue']['reading_value']);
						}
						if(parseInt(vals[i]['LightValue']['lab_zone']) == 2){
							$('#L2').html(vals[i]['LightValue']['reading_value']);
					
						}
						if(parseInt(vals[i]['LightValue']['lab_zone']) == 3){
							$('#L3').html(vals[i]['LightValue']['reading_value']);
			
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
							$('#T1').html(res);
						}
						if(parseInt(vals[x]['TempValue']['lab_zone']) == 2){
							var str = vals[x]['TempValue']['reading_value'];
							var res = str.slice(0,2);
							$('#T2').html(res);
						}
						if(parseInt(vals[x]['TempValue']['lab_zone']) == 3){
							var str = vals[x]['TempValue']['reading_value'];
							var res = str.slice(0,2);
							$('#T3').html(res);
						}
					}
				});
		}
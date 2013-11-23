


function getLiveLight(){
			var request = $.ajax({
				url: window.location.origin + "/graphs/getLightValue",
				type: "POST",
				data:{},
				dataType: 'json',
				async: false
				});
				request.done(function(data){
					var vals = data.results
					var i = 0;
					for(i = 0; i < vals; i++){
						console.log(vals.length);
						if(parseInt(vals[i]['LightValue']['lab_zone']) == 1){
							$('#L1').empty();
							$('#L1').load(vals[i]['LightValue']['reading_value']).fadeIn("slow");
						}
						if(parseInt(vals[i]['LightValue']['lab_zone']) == 2){
							$('#L2').empty();
							$('#L2').load(vals[i]['LightValue']['reading_value']).fadeIn("slow");
						}
						if(parseInt(vals[i]['LightValue']['lab_zone']) == 3){
							$('#L3').empty();
							$('#L3').load(vals[i]['LightValue']['reading_value']).fadeIn("slow");
						}
					}
				});
		}
		
		
		
		/*
		*TEMPERATURE
		*/
		function getLiveTemp(){
			var request = $.ajax({
				url: window.location.origin + "/graphs/getTempValue",
				type: "POST",
				data:{},
				dataType: 'json',
				async: false
				});
				request.done(function(data){
					var valsTemp = data.Tempresults;
					var x = 0;
					for(x = 0; x < valsTemp; x++){
						if(parseInt(valsTemp[x]['TempValue']['lab_zone']) == 1){
							$('#T1').empty();
							$('#T1').load(valsTemp[x]['TempValue']['reading_value']).fadeIn("slow");
						}
						if(parseInt(valsTemp[x]['TempValue']['lab_zone']) == 2){
							$('#T2').empty();
							$('#T2').load(valsTemp[x]['TempValue']['reading_value']).fadeIn("slow");
						}
						if(parseInt(valsTemp[x]['TempValue']['lab_zone']) == 3){
							$('#T3').empty();
							$('#T3').load(valsTemp[x]['TempValue']['reading_value']).fadeIn("slow");
						}
					}
			});
		}
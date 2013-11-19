
function populateDayList(){
	daylist = new Array();
	var request =
	$.ajax({
		url: window.location.origin + "/graphs/getdaylist",
		type:"POST",
		async:false,		
		dataType:"json"
	});

	request.done(function(msg){
		daylist = msg.dates;
		for(var i = 0; i < daylist.length; i++){
            $("#temp-date-sel").append("<option>" + daylist[i] + "</option>");
            $("#light-date-sel").append("<option>" + daylist[i] + "</option>");
        }
		window.curDate = daylist[0];
	});
	
}

function dateChangeLight(){
	curDate = $("#light-date-sel").find(":selected").text();
	drawDailyLightChart();
	populateHourListLight();
}
function dateChangeTemp(){
	curDate = $("#temp-date-sel").find(":selected").text();
	drawDailyTempChart();
	populateHourListTemp();
}
function hourChangeTemp(){
	curTime = $("#temp-hour-sel").find(":selected").text();
	curDateTime = curDate.concat(" ", curTime);
	drawHourlyTempChart();
}
function hourChangeLight(){
    curTime = $("#light-hour-sel").find(":selected").text();
    curDateTime = curDate.concat(" ", curTime);
    drawHourlyTempChart();
}

function populateHourListTemp(){
	hourlist = new Array();
	var request = $.ajax({
		url:"/overview/gethourlisttemp",
		async:false,		
		type:"POST",
		data: {curDate : window.curDate},
		dataType:"json"
	});
	request.done(function(msg){
		hourlist = msg.hours;
		
			$('#temp-hour-sel option').each(function() {
			        $('#temp-hour-sel option').remove();
			});
		
		for(i = 0; i < hourlist.length; i++){
			$("#temp-hour-sel").append("<option>" + hourlist[i] + "</option>");
		}
	});
}
function populateHourListLight(){
    hourlist = new Array();
    var request = $.ajax({
        url: window.location.origin + "/graphs/gethourlistlight",
        async:false,        
        type:"POST",
        data: {curDate : window.curDate},
        dataType:"json"
    });
    request.done(function(msg){
        hourlist = msg.hours;
        
            $('#light-hour-sel option').each(function() {
                    $('#light-hour-sel option').remove();
            });
        
        for(i = 0; i < hourlist.length; i++){
            $("#light-hour-sel").append("<option>" + hourlist[i] + "</option>");
        }
    });
}

function drawDailyTempChart() {
    
    var datesAndValuesArray = [[]];
    var dateFmt = new Date(curDate);
    
    var dataTable = new google.visualization.DataTable();
    
    dataTable.addColumn('number', 'Hour');
    dataTable.addColumn('number', 'Average Temperature');
    
    var request = 
    $.ajax(window.location.origin + "/graphs/getAverageTempData/",
    {
        type: "POST",
        data: {curDate: curDate},
        dataType: "JSON"
    });
    
    
    request.done(function(data){
        
        var averages = data.averages;
        var i = 1;
        for(i; i < averages.length; i++){
        	var tblDate = new Date(averages[i]['AverageTempValue']['timestamp']);
        	console.log(averages[i]['AverageTempValue']['reading_value']);
        	console.log(tblDate);
            dataTable.addRows([[tblDate.getHours(), parseInt(averages[i]['AverageTempValue']['reading_value'])]]);
        }
    
        var dataView = new google.visualization.DataView(dataTable);
        //dataView.setColumns([{calc: function(data, row) { return data.getFormattedValue(row, 0); }, type:'string'}, 1, 2, 3]);

        var chart = new google.visualization.ColumnChart(document.getElementById('static-temp-chart'));
        var options = {
            title: 'Hourly Averages for ' + curDate,
            vAxis: {title: 'Value (Degrees C)',
        			minValue: 0,
        			maxValue: 100},
            hAxis: {title: 'Hour', minValue: 0, maxValue: 24, showTextEvery: 1,
             	ticks: [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24]},
            width: 800, height: 400,
            legend: 'none',
            pointSize: 5,
            interpolateNulls : true
        };
        chart.draw(dataView, options);        
    });
}
function drawHourlyTempChart() {
    
    var datesAndValuesArray = [[]];
    var dateFmt = new Date(curDate);
    
    var dataTable = new google.visualization.DataTable();
    
    dataTable.addColumn('number', 'Minute');
    dataTable.addColumn('number', 'Average Temperature');
    
    var request = 
    $.ajax(window.location.origin + "/graphs/getRawTempData/",
    {
        type: "POST",
        data: {curDateTime: curDateTime},
        dataType: "JSON"
    });
    
    
    request.done(function(data){
        
        var raw = data.raw;
        var i = 1;
        var ticksArray = new Array();
        for(i = 1; i<61; i++){
        	ticksArray.push(i);
        }
        for(i=0; i < raw.length; i++){
        	var tblDate = new Date(raw[i]['TempValue']['timestamp']);
            dataTable.addRows([[tblDate.getMinutes(), parseFloat(raw[i]['TempValue']['reading_value'])]]);
        }
    
        var dataView = new google.visualization.DataView(dataTable);
        //dataView.setColumns([{calc: function(data, row) { return data.getFormattedValue(row, 0); }, type:'string'}, 1, 2, 3]);

        var chart = new google.visualization.ColumnChart(document.getElementById('static-temp-chart'));
        var options = {
            title: 'Raw Values for ' + curDateTime,
            vAxis: {title: 'Value (Degrees C)',
        			minValue: 0,
        			maxValue: 100},
            hAxis: {title: 'Minute', minValue: 0, maxValue: 60, showTextEvery: 5,
             	ticks: ticksArray},
            width: 1200, height: 600,
            legend: 'none',
            pointSize: 0.5
        };
        chart.draw(dataView, options);        
    });
}
function drawDailyLightChart() {
    
    var datesAndValuesArray = [[]];
    var dateFmt = new Date(curDate);
    
    var dataTable = new google.visualization.DataTable();
    
    dataTable.addColumn('number', 'Hour');
    dataTable.addColumn('number', 'Average Light Value');
    
    var request = 
    $.ajax(window.location.origin + "/graphs/getAverageLightData/",
    {
        type: "POST",
        data: {curDate: curDate},
        dataType: "JSON"
    });
    
    
    request.done(function(data){
        
        var averages = data.averages;
        var i = 1;
        for(i; i < averages.length; i++){
        	var tblDate = new Date(averages[i]['AverageLightValue']['timestamp']);
        	console.log(averages[i]['AverageLightValue']['reading_value']);
        	console.log(tblDate);
            dataTable.addRows([[tblDate.getHours(), parseInt(averages[i]['AverageLightValue']['reading_value'])]]);
        }
    
        var dataView = new google.visualization.DataView(dataTable);
        var chart = new google.visualization.ColumnChart(document.getElementById('static-light-chart'));
        var options = {
            title: 'Hourly Averages for ' + curDate,
            vAxis: {title: 'Light Value (Lux)'},
            hAxis: {title: 'Hour', minValue: 0, maxValue: 24, showTextEvery: 1,
             	ticks: [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24]},
            width: 800, height: 400,
            legend: 'none',
            pointSize: 5,
            interpolateNulls : true
        };
        chart.draw(dataView, options);
        $("#static-light-chart").show();
    });
}
function drawHourlyTempChart() {
    
    var datesAndValuesArray = [[]];
    var dateFmt = new Date(curDate);
    
    var dataTable = new google.visualization.DataTable();
    
    dataTable.addColumn('number', 'Minute');
    dataTable.addColumn('number', 'Light Value (Lux)');
    
    var request = 
    $.ajax(window.location.origin + "/graphs/getRawLightData/",
    {
        type: "POST",
        data: {curDateTime: curDateTime},
        dataType: "JSON"
    });
    
    
    request.done(function(data){
        
        var raw = data.raw;
        var i = 1;
        var ticksArray = new Array();
        for(i = 1; i<61; i++){
            ticksArray.push(i);
        }
        for(i=0; i < raw.length; i++){
            var tblDate = new Date(raw[i]['LightValue']['timestamp']);
            dataTable.addRows([[tblDate.getMinutes(), parseFloat(raw[i]['LightValue']['reading_value'])]]);
        }
    
        var dataView = new google.visualization.DataView(dataTable);
        //dataView.setColumns([{calc: function(data, row) { return data.getFormattedValue(row, 0); }, type:'string'}, 1, 2, 3]);

        var chart = new google.visualization.ColumnChart(document.getElementById('static-light-chart'));
        var options = {
            title: 'Raw Values for ' + curDateTime,
            vAxis: {title: 'Value (Lux)',
                    minValue: 0,
                    maxValue: 100},
            hAxis: {title: 'Minute', minValue: 0, maxValue: 60, showTextEvery: 5,
                ticks: ticksArray},
            width: 1200, height: 600,
            legend: 'none',
            pointSize: 0.5
        };
        chart.draw(dataView, options);     
        
        $("#static-temp-chart").show();
    });
}

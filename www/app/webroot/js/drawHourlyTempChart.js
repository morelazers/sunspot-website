// Callback that creates and populates a data table, 
// instantiates the pie chart, passes in the data and
// draws it.
function drawHourlyTempChart(days) {
    
    var datesAndValuesArray = [[]];
    var pastDate = new Date();
    var currentTime = new Date();
    
    var dataTable = new google.visualization.DataTable();
    
    dataTable.addColumn('number', 'Hour');
    dataTable.addColumn('number', 'Zone 1 Temperature');
    dataTable.addColumn('number', 'Zone 2 Temperature');
    dataTable.addColumn('number', 'Zone 3 Temperature');
    
    var request = 
    $.ajax(window.location.origin + "/graphs/getHourlyTempData/",
    {
        type: "POST",
        data: {daysToGoBack: days},
        dataType: "JSON"
    });
    
    
    request.done(function(data){
        
        var zone1Vals = data.zone1Vals;
        var zone2Vals = data.zone2Vals;
        var zone3Vals = data.zone3Vals;
        
        var newZone1TempVals = [];
        var newZone2TempVals = [];
        var newZone3TempVals = [];
        for (var i = 0; i <= 31; i++) {
            var result = zone1Vals[i];
            newZone1TempVals.push(parseInt(result));
            var result = zone2Vals[i];
            newZone2TempVals.push(parseInt(result));
            var result = zone3Vals[i];
            newZone3TempVals.push(parseInt(result));
        }
        
        var i = 1;
        for(i; i <= 24; i++){
            dataTable.addRows([[pastDate.getUTCDate(), newZone1TempVals[i], newZone2TempVals[i], newZone3TempVals[i]]]);
        }
    
        var dataView = new google.visualization.DataView(dataTable);
        dataView.setColumns([{calc: function(data, row) { return data.getFormattedValue(row, 0); }, type:'string'}, 1, 2, 3]);
        
        pastDate.setDate(currentTime.getDate() - days); 
        var day = pastDate.getDate();
        var month = pastDate.getMonth() + 1;
        
        var chart = new google.visualization.LineChart(document.getElementById('hourly-chart-div'));
        var options = {
            title: 'Daily Temperature Data for ' + day + '/' + month,
            vAxis: {title: 'Value (Degrees C)'},
            hAxis: {title: 'Hour'},
            width: 1000, height: 400,
            legend: 'none',
            pointSize: 5,
            interpolateNulls : true
        };
        chart.draw(dataView, options);
        
        if(data.daysBack !== ''){
            
            var newPreviousVal = parseInt(data.daysBack) + parseInt(1);
            var newNextVal = parseInt(data.daysBack) - parseInt(1);

            $(".day-left-button").unbind();
            

            $(".day-left-button").bind("click", function() {drawHourlyTempChart(newPreviousVal)});
            if(newNextVal < 0){
                /*$(".live-switch").toggleClass("switched", 200);
                $(".live-switch").html("<b>Live</b>");*/
            } else if (newNextVal >= 0){
                $(".day-right-button").unbind();
                $(".day-right-button").bind("click", function() {drawHourlyTempChart(newNextVal)});
            }
        }
        
    });
}
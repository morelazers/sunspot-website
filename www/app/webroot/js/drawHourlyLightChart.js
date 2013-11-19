// Function to get the light data for the past month and to populate the line chart with it
function drawHourlyLightChart(days) {

    var datesAndValuesArray = [[]];
    var pastDate = new Date();
    var currentTime = new Date();
    
    var dataTable = new google.visualization.DataTable();
    
    dataTable.addColumn('number', 'Hour');
    dataTable.addColumn('number', 'Zone 1 Value');
    dataTable.addColumn('number', 'Zone 2 Value');
    dataTable.addColumn('number', 'Zone 3 Value');
    
    var request = 
    $.ajax(window.location.origin + "/graphs/getHourlyLightData/",
    {
        type: "POST",
        data: {daysToGoBack: days},
        dataType: "JSON"
    });
    
    
    request.done(function(data){
        
        var zone1Vals = data.zone1Vals;
        var zone2Vals = data.zone2Vals;
        var zone3Vals = data.zone3Vals;
        
        var newZone1LightVals = [];
        var newZone2LightVals = [];
        var newZone3LightVals = [];
        for (var i = 0; i <= 31; i++) {
            var zone1Result = zone1Vals[i];
            newZone1LightVals.push(parseInt(zone1Result));
            var zone2Result = zone2Vals[i];
            newZone2LightVals.push(parseInt(zone2Result));
            var zone3Result = zone3Vals[i];
            newZone3LightVals.push(parseInt(zone3Result));
        }
        
        var i = 1;
        for(i; i <= 24; i++){
            dataTable.addRows([[i, newZone1LightVals[i], newZone2LightVals[i], newZone3LightVals[i]]]);
        }
        
        var dataView = new google.visualization.DataView(dataTable);
        
        dataView.setColumns([{calc: function(data, row) { return data.getFormattedValue(row, 0); }, type:'string'}, 1, 2, 3]);
        
        pastDate.setDate(currentTime.getDate() - days); 
        var day = pastDate.getDate();
        var month = pastDate.getMonth() + 1;
        
        var chart = new google.visualization.LineChart(document.getElementById('hourly-chart-div'));
        var options = {
            title: 'Daily Light Data for ' + day + '/' + month,
            vAxis: {title: 'Value (Lux)'},
            hAxis: {title: 'Hour'},
            width: 1000, height: 400,
            legend: 'none',
            pointSize: 5,
            interpolateNulls : true
        };
        chart.draw(dataView, options);
        
        if(data.daysBack !== ''){

            /*if(data.daysBack == 1){
                if(!$(".live-switch").hasClass("switched")){
                    $(".live-switch").toggleClass("switched", 200);
                    $(".live-switch").html("<b>History</b>");
                }
            }*/

            var newPreviousVal = parseInt(data.daysBack) + parseInt(1);
            var newNextVal = parseInt(data.daysBack) - parseInt(1);

            $(".day-left-button").unbind();
            

            $(".day-left-button").bind("click", function() {drawHourlyLightChart(newPreviousVal)});
            if(newNextVal < 0){
                /*$(".live-switch").toggleClass("switched", 200);
                $(".live-switch").html("<b>Live</b>");*/
            } else if (newNextVal >= 0){
                $(".day-right-button").unbind();
                $(".day-right-button").bind("click", function() {drawHourlyLightChart(newNextVal)});
            }
            
        }
    });
    
}
// Function to get the light data for the past month and to populate the line chart with it
function drawDailyLightChart(months) {
    
    //var lightVals = [12,12,2,34,3,3,5,7,3,1,5,7,8,3];
    
    
    var datesAndValuesArray = [[]];
    var pastDate = new Date();
    var currentTime = new Date();
    
    var dataTable = new google.visualization.DataTable();
    
    dataTable.addColumn('number', 'Day');
    dataTable.addColumn('number', 'Average Value');
    
    var request = 
    $.ajax(window.location.origin + "/graphs/getDailyLightData/",
    {
        type: "POST",
        data: {monthsToGoBack: months},
        dataType: "JSON"
    });
    
    
    request.done(function(data){
        
        var averageVals = data.values;
        
        var newAverageLightVals = [];
        for (var i = 0; i <= 31; i++) {
            var result = averageVals[i];
            newAverageLightVals.push(parseInt(result));
        }
        
        var i = 1;
        for(i; i <= 31; i++){
            pastDate.setDate(currentTime.getDate() - 30 + i);
            dataTable.addRows([[pastDate.getDate(), newAverageLightVals[i]]]);
        }
        
        pastDate.setMonth(currentTime.getMonth() - months); 
        var month = parseInt(pastDate.getMonth()) + parseInt(1);
        var year = pastDate.getFullYear();
        
        var dataView = new google.visualization.DataView(dataTable);
        dataView.setColumns([{calc: function(data, row) { return data.getFormattedValue(row, 0); }, type:'string'}, 1]);
        
        var chart = new google.visualization.LineChart(document.getElementById('daily_chart_div'));
        var options = {
            title: 'Average Daily Light Values for ' + month + '/' + year,
            vAxis: {title: 'Value (Lux)'},
            hAxis: {title: 'Day'},
            width: 1000, height: 400,
            legend: 'none',
            pointSize: 5,
            interpolateNulls: true
        };
        chart.draw(dataView, options);
        
            if(data.monthsBack !== ''){
            var newPreviousVal = parseInt(data.monthsBack) + parseInt(1);
            var newNextVal = parseInt(data.monthsBack) - parseInt(1);
            
            $("#previous-month").attr('onclick', 'drawDailyLightChart('+ newPreviousVal +')');
            $("#next-month").attr('onclick', 'drawDailyLightChart('+ newNextVal +')');
            if(data.monthsBack > 0){
                $("#next-month").attr('disabled', false);
            } else {
                $("#next-month").attr('disabled', true);
            }
        }
        
    });
    
}
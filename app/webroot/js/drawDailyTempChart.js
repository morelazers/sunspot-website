// Callback that creates and populates a data table, 
// instantiates the pie chart, passes in the data and
// draws it.
function drawDailyTempChart(months) {
    
    // Replace this with an AJAX call to get the temp data for the past month
    //var averageVals = [1,2,3,4,5,6,7,8,9,10,1,2,3,4,5,6,7,8,9,10,1,2,3,4,5,6,7,8,9,10,1,2,3,4,5,6,7,8,9,10,1,2,3,4,5,6,7,8,9,10];
    
    var datesAndValuesArray = [[]];
    var pastDate = new Date();
    var currentTime = new Date();
    
    var dataTable = new google.visualization.DataTable();
    
    dataTable.addColumn('number', 'Day');
    dataTable.addColumn('number', 'Average Temperature');
    
    var request = 
    $.ajax(window.location.origin + "/graphs/getDailyTempData/",
    {
        type: "POST",
        data: {monthsToGoBack: months},
        dataType: "JSON"
    });
    
    
    request.done(function(data){
        
        var averageVals = data.values;
                
        var newTempVals = [];
        for (var i = 0; i <= 31; i++) {
            var result = averageVals[i];
            newTempVals.push(parseInt(result));
        }
    
        var i = 1;
        for(i; i <= 31; i++){
            pastDate.setDate(currentTime.getDate() - 30 + i);
            dataTable.addRows([[pastDate.getDate(), newTempVals[i]]]);
        }
        
        pastDate.setMonth(currentTime.getMonth() - months); 
        var month = parseInt(pastDate.getMonth()) + parseInt(1);
        var year = pastDate.getFullYear();
    
        var dataView = new google.visualization.DataView(dataTable);
        dataView.setColumns([{calc: function(data, row) { return data.getFormattedValue(row, 0); }, type:'string'}, 1]);
        
        var chart = new google.visualization.LineChart(document.getElementById('daily_chart_div'));
        var options = {
            title: 'Average Daily Temperature Data for ' + month + '/' + year,
            vAxis: {title: 'Value (Degrees C)'},
            hAxis: {title: 'Day'},
            width: 1000, height: 400,
            legend: 'none',
            pointSize: 5
        };
        chart.draw(dataView, options);
        
        console.log(months);
        
        if(months !== '0'){
            var newPreviousVal = parseInt(months) + parseInt(1);
            var newNextVal = parseInt(months) - parseInt(1);
            
            $("#previous-month").attr('onclick', 'drawDailyTempChart('+ newPreviousVal +')');
            $("#next-month").attr('onclick', 'drawDailyTempChart('+ newNextVal +')');
            if(months > 0){
                $("#next-month").attr('disabled', false);
            } else {
                $("#next-month").attr('disabled', true);
            }
        }
        
    });
}
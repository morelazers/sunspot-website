function drawLiveLightChart(){
    var tmpTime = liveTime.getTime();
    var request = $.ajax({
        url: window.location.origin + '/graphs/getLiveLightData',
        type: "POST",
        data: {tmpTime : tmpTime},
        dataType: 'json',
        async: false
    });
    request.done(function(data){
        var vals = data.vals;
        var dataTbl = new google.visualization.DataTable();
        dataTbl.addColumn('string', 'Time');
        dataTbl.addColumn('number', 'Zone 1');
        dataTbl.addColumn('number', 'Zone 2');
        dataTbl.addColumn('number', 'Zone 3');
        var i = 0;
        for(i=0; i < vals.length; i++){
            console.log(vals.length);
            var tblDate = new Date(vals[i]['LightValue']['timestamp']);
            if(parseInt(vals[i]['LightValue']['lab_zone']) == 1){
                dataTbl.addRows([[tblDate.toTimeString(), parseInt(vals[i]['LightValue']['reading_value']), null, null]]);
            }
            if(parseInt(vals[i]['LightValue']['lab_zone']) == 2){
                dataTbl.addRows([[tblDate.toTimeString(), null, parseInt(vals[i]['LightValue']['reading_value']), null]]);
            }
            if(parseInt(vals[i]['LightValue']['lab_zone']) == 3){
                dataTbl.addRows([[tblDate.toTimeString(),  null, null, parseInt(vals[i]['LightValue']['reading_value'])]]);
            }
        }
        var options = {
            title: 'Live Chart From ' + liveTime.toString(),
            vAxis: {title: 'Value (Lux)',
                    minValue: 0,
                    maxValue: 100},
            hAxis: {title: 'Time',
                    showTextEvery: 10},
            width: 800, height: 400,
            pointSize: 5
        };
        var chart = new google.visualization.LineChart(document.getElementById('live-light-chart'));
        chart.draw(dataTbl, options);
    });
}
function drawLiveTempChart(){
    var tmpTime = liveTime.getTime();
    var request = $.ajax({
        url: window.location.origin + '/graphs/getLiveTempData',
        type: "POST",
        data: {tmpTime : tmpTime},
        dataType: 'json',
        async: false
    });
    request.done(function(data){
        var vals = data.vals;
        var dataTbl = new google.visualization.DataTable();
        dataTbl.addColumn('string', 'Time');
        dataTbl.addColumn('number', 'Zone 1');
        dataTbl.addColumn('number', 'Zone 2');
        dataTbl.addColumn('number', 'Zone 3');
        var i = 0;
        for(i=0; i < vals.length; i++){
            console.log(vals.length);
            var tblDate = new Date(vals[i]['TempValue']['timestamp']);
            if(parseInt(vals[i]['TempValue']['lab_zone']) == 1){
                dataTbl.addRows([[tblDate.toTimeString(), parseInt(vals[i]['TempValue']['reading_value']), null, null]]);
            }
            if(parseInt(vals[i]['TempValue']['lab_zone']) == 2){
                dataTbl.addRows([[tblDate.toTimeString(), null, parseInt(vals[i]['TempValue']['reading_value']), null]]);
            }
            if(parseInt(vals[i]['TempValue']['lab_zone']) == 3){
                dataTbl.addRows([[tblDate.toTimeString(),  null, null, parseInt(vals[i]['TempValue']['reading_value'])]]);
            }
        }
        var options = {
            title: 'Live Chart From ' + liveTime.toString(),
            vAxis: {title: 'Value (Degrees C)',
                    minValue: 0,
                    maxValue: 100},
            hAxis: {title: 'Time',
                    showTextEvery: 10},
            width: 800, height: 400,
            pointSize: 5
        };
        var chart = new google.visualization.LineChart(document.getElementById('live-temp-chart'));
        chart.draw(dataTbl, options);
    });
}
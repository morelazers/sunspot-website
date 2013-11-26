$(document).ready(function(){ //DOM Ready

	$('.item-list').shapeshift({
		animateOnInit: true
	});

	$('.main').shapeshift({
		minHeight: 600,
		align: "center"
	});

	var containers = $(".main");

	$(".main div").draggable();

	containers.on("ss-added", function(){
		var mainAreaDivs = $(".main div");
		var noInMainArea = mainAreaDivs.length;
		console.log(noInMainArea);
	});

	/*var options = {
		widget_selector: $(".gridster div"),
        widget_margins: [10, 10],
        widget_base_dimensions: [140, 140],
        min_cols: 10
    }

    var divs = [
    	'<div class="list-item">SOMETHING</div>',
    	'<div class="list-item">SOMETHING ELSE</div>',
    	'<div class="list-item">SOMETHING TOO</div>',
    	'<div class="list-item">SOMETHING BREAK</div>',
    	'<div class="list-item">SOMETHING HGUEHUE</div>'
    ];

	

	var gridster = $(".gridster div").gridster().data('gridster');

    for(i = 0; i < divs.length; i++){
    	gridster.add_widget(divs[i], 1, 1, i+1, 1);
    }

    $(".gridster div").gridster(options);

    $(".list-item").css('position', 'relative');*/
    
});
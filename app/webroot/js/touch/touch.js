var gridster

$(document).ready(function(){ //DOM Ready

	gridster = $(".gridster > ul").gridster({
        widget_margins: [10, 10],
        widget_base_dimensions: [300, 300]
    }).data('gridster');

	addMovementWidget();
	addSwitchWidget();
	addInteractionWidget();
	addLiveChartsWidget();
	
});

function addMovementWidget(){
	gridster.add_widget('<li><div id="movement" class="grid-item"><div id="lab-zone-overlay"><div id="live-user-location-zones"><div id="zone-1" class="lab-zone zone-1"></div><div id="zone-2" class="lab-zone zone-2"></div><div id="zone-3" class="lab-zone zone-3"></div><div id="zone-4" class="lab-zone zone-4"></div><div id="zone-5" class="lab-zone zone-5"></div><div id="zone-6" class="lab-zone zone-6"></div><div id="user-test" class="live-user-location zone-1"></div></div></div></div></li>', 3, 1)
	.resizable();
}

function addSwitchWidget(){
	gridster.add_widget('<li><div id="switch-colour-box" class="grid-item"></div></li>')
	.resizable();
}

function addInteractionWidget(){
	gridster.add_widget('<li><div id="live-interactions" class="grid-item"><div id="live-interaction-images"><div id="live-door-interactions" class="live-interaction-widget"></div><div id="live-fridge-interactions" class="live-interaction-widget"></div><div id="live-whiteboard-interactions" class="live-interaction-widget"></div></div></li>', 1, 1)
	.resizable();
}

function addLiveChartsWidget(){
	gridster.add_widget('<div id="live-lab-charts"><div id="live-light-con"><div id="live-light-chart" class="live-chart"></div></div><div id="live-temp-con"><div id="live-temp-chart" class="live-chart"></div></div></div>')
	.resizable();
}
$(document).ready(function(){
  
	window.updateMovement = window.setInterval(getLiveMovement, 1000);
	window.updateSwitch = window.setInterval(getLiveSwitchPress, 500);
	window.updateLight = window.setInterval(drawLiveLightChart, 10000);
	window.updateTemp = window.setInterval(drawLiveTempChart, 10000);
	window.updateLightWidget = window.setInterval(getLiveLight, 500);
	window.updateTempWidget = window.setInterval(getLiveTemp, 500);
	window.updateInteractionWidget = window.setInterval(getInteractionData, 500);
  

  
});

  function stopAllLiveUpdates(){

    console.log("STOPPING UPDATES");
    console.log(window.updateMovement);
    
    clearInterval(window.updateMovement);
    clearInterval(window.updateLight);
    clearInterval(window.updateTemp);
    clearInterval(window.updateSwitch);
    clearInterval(window.updateLightWidget);
    clearInterval(window.updateTempWidget);
	  clearInterval(window.updateInteractionWidget);
    
    
    console.log(window.updateMovement);

  }
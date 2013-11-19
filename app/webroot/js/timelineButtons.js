$(document).ready(function(){
    
    $("#busiest-hour").hide();
    $("#busiest-day").hide();
    
    $(".timeline-button").click(function(event){
        $(".timeline-button").parent().removeClass("active");
        $(this).parent().addClass("active");
        $(".door").hide();
        $(".fridge").hide();
        $(".whiteboard").hide();
        $("#busiest-hour").hide();
        $("#busiest-day").hide();
        var obj = $(this).html();
        if(obj === "All"){
            $(".door").show();
            $(".fridge").show();
            $(".whiteboard").show();
        } else if(obj === "Busiest hour"){
            $("#busiest-hour").show();
        } else if(obj === "Busiest day"){
            $("#busiest-day").show();
        } else {
            $("." + obj.toLowerCase()).show();
        }
    });
    
});


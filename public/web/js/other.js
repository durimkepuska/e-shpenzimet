
$('#return-to-top').click(function() {
    $('body,html').animate({
        scrollTop : 0
    }, 500);
});

$(window).scroll(function() {
    if ($(this).scrollTop() >= 50) {
        $('#return-to-top').fadeIn(200);
    } else {
        $('#return-to-top').fadeOut(200);
    }
});



$("#chart_container").click(function() {
    $("#info_panel").html($(".highcharts-legend g g g text").html());
});

$("#chart_container").ready(function() {
    $("#info_panel").html($(".highcharts-legend g g g text").html());
});

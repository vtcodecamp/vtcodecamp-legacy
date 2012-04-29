$(document).ready(function() {
    $("[data-svg-replace=true]").each(function() {
        var src = $(this).css("backgroundImage").match(/^url\("(.*)"\)$/)[1];
        $(this).svg({
            loadURL: src,
            onLoad: function() {
                $(this).css({"background-image": "none"});
            }
        });
    });
    $("#ribbon").mouseover(function() {
        $(this).stop().animate({
            "backgroundColor": "blue"
        }, 200);
    }).mouseout(function() {
        $(this).stop().animate({
            "backgroundColor": "green"
        }, 200);
    });
    if ($("#ribbon h1").length > 0) {
        var elementToReplace = $("#ribbon h1").get(0);
        var canvasWidth = $(elementToReplace).innerWidth();
        var canvasHeight = $(elementToReplace).innerHeight();
        var canvasPadding = 20;
        var canvasNotchWidth = canvasWidth * 0.05;
        var canvas = $("<canvas width=\"" + (canvasWidth + (canvasPadding * 2)) + "\" height=\"" + (canvasHeight + canvasPadding) + "\" class=\"ribbon\" />").prependTo(elementToReplace).css({
            "left": "+=" + (-canvasPadding) + "px"
        }).get(0);
        if (canvas.getContext) {
            $(elementToReplace).css({
                "paddingRight": "+=" + canvasNotchWidth + "px"
            });
            var ctx = canvas.getContext("2d");
            var lineargradient = ctx.createLinearGradient(0, 0, 0, canvasHeight);
            lineargradient.addColorStop(0, "#555");
            lineargradient.addColorStop(1, "#333");
            ctx.fillStyle = lineargradient;
            ctx.shadowColor = "rgba(0, 0, 0, 0.6)";
            ctx.shadowBlur = 15;
            ctx.shadowOffsetX = "0";
            ctx.shadowOffsetY = 5;
            ctx.beginPath();
            ctx.moveTo(canvasPadding, 0);
            ctx.lineTo(canvasPadding + canvasWidth + canvasNotchWidth, 0);
            ctx.lineTo(canvasPadding + canvasWidth, canvasHeight / 2);
            ctx.lineTo(canvasPadding + canvasWidth + canvasNotchWidth, canvasHeight);
            ctx.lineTo(canvasPadding, canvasHeight);
            ctx.closePath();
            ctx.fill();
            $(elementToReplace).css({
                "backgroundColor": "transparent",
                "backgroundImage": "none",
                "boxShadow": "none"
            });
        };
    };
    $("#vermont-code-camp-logo").mouseover(function() {
        $(this).find("#hover").stop().animate({
            "opacity": "1"
        }, 200, function() {
            $(this).siblings("#default").hide();
        });
    }).mouseout(function() {
        $(this).find("#default").show().siblings("#default").stop().animate({
            "opacity": "1"
        }, 200);
        $(this).find("#hover").stop().animate({
            "opacity": "0"
        }, 200); 
    });
});

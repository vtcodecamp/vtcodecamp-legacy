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
    if ($("footer#ribbon").length > 0) {
        var elementToReplace = $("footer#ribbon").get(0);
        var canvasWidth = $(elementToReplace).innerWidth();
        var canvasHeight = $(elementToReplace).innerHeight();
        var canvasPadding = 20;
        var canvas = $("<canvas width=\"" + (canvasWidth + (canvasPadding * 2)) + "\" height=\"" + (canvasHeight + canvasPadding) + "\" class=\"ribbon\" />").prependTo(elementToReplace).css({
            "left": "+=" + (-canvasPadding) + "px"
        }).get(0);
        if (canvas.getContext) {
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
            ctx.lineTo(canvasPadding + canvasWidth, 0);
            ctx.lineTo(canvasPadding + canvasWidth, canvasHeight);
            ctx.lineTo(canvasPadding + (canvasWidth / 2), canvasHeight * 0.85);
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

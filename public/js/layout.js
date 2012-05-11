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
    function determineCurrentSection(scrollDirection) {
        var currentSectionId;
        var scrollingThreshold = 0;
        if (scrollDirection == "down") {
            scrollingThreshold = $(window).height() * 0.50;
        } else if (scrollDirection == "up") {
            scrollingThreshold = $(window).height() * 0.80;
        }
        var windowOffsetTop = $(window).scrollTop();
        $("section.anchor").each(function() {
            var id = $(this).attr("id");
            var elementOffsetTop = $(this).offset().top;
            var elementOffsetFromWindow = elementOffsetTop - windowOffsetTop;
            if (elementOffsetFromWindow < (scrollingThreshold + 1)) {
                currentSectionId = id;
            } else {
                return false;
            }
        });
        return currentSectionId;
    }
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
    if ($("#ribbon nav").length > 0) {
        var ribbonNav = $("#ribbon nav");
        var svgWidth = $(ribbonNav).innerWidth();
        var svgHeight = $(ribbonNav).innerHeight();
        var svgBackgroundColor = $(ribbonNav).css("backgroundColor");
        var svgBackgroundImage = $(ribbonNav).css("backgroundImage");
        var markerWidth = 25;
        var markerHeight = 15;
        $(ribbonNav).svg({
            settings: {
                "id": "ribbon-nav",
                "width": "100%",
                "height": svgHeight
            },
            onLoad: function(svg) {
                var defs = svg.defs();
                svg.linearGradient("background-gradient", [[0, "rgba(0, 130, 192, 0.8)"], [1, "rgba(0, 130, 192, 0.9)"]], 0, 0, 0, "100%");
                var bandingTemplate = svg.rect(defs, 0, 0, svgWidth, svgHeight, {
                    "id": "banding-template"
                });
                var banding = svg.use("#banding-template", {
                    "id": "banding",
                    "fill": "url(#background-gradient)"
                });
                var marker = svg.polygon([[markerWidth / 2, svgHeight - markerHeight], [markerWidth, svgHeight], [0, svgHeight]], {
                    "id": "marker",
                    "fill": "white"
                });
                ribbonNav.css({
                    "backgroundColor": "transparent",
                    "backgroundImage": "none",
                    "boxShadow": "none"
                });
                function setMarkerOffset(centerX) {
                    var markerOffsetX = centerX - (markerWidth / 2);
                    $(marker).css({
                        "opacity": "0.9"
                    }).stop().animate({
                        "svgTransform": "translate(" + markerOffsetX + ",0)"
                    }, 1000, function() {
                        $(this).css({
                            "opacity": "1.0"
                        });
                    });
                }
                function setCurrentSection(currentSectionId) {
                    var currentSectionAnchorLinkCenterX = $(ribbonNav).find("a[data-anchor=" + currentSectionId + "]").offset().left + ($(ribbonNav + "a[data-anchor=" + currentSectionId + "]").innerWidth() / 2);
                    setMarkerOffset(currentSectionAnchorLinkCenterX);
                }
                var lastScrollTop = $(window).scrollTop();
                $(window).scroll(function(e) {
                    var scrollDirection;
                    var currentScrollTop = $(window).scrollTop();
                    if (currentScrollTop > lastScrollTop) {
                        scrollDirection = "down";
                    } else {
                        scrollDirection = "up";
                    }
                    lastScrollTop = currentScrollTop;
                    setCurrentSection(determineCurrentSection(scrollDirection));
                });
                $(window).resize(function() {
                    var newWidth = $(ribbonNav).innerWidth();
                    svg.change(bandingTemplate, {
                        "width": newWidth
                    });
                });
                setCurrentSection(determineCurrentSection());
            }
        });
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
    var scrolling = 0;
    $(".anchor").bind("scrollTo", function(e) {
        var scrollTarget = "#" + $(this).attr("id");
        scrolling++;
        $.smoothScroll({
            scrollTarget: scrollTarget,
            afterScroll: function () {
                if (1 == scrolling) {
                    location.hash = scrollTarget;
                }
                scrolling--;
            }
        });
    });
    $("a[data-anchor]").click(function() {
        $($(this).attr("href")).trigger("scrollTo");
        return false;
    });
});

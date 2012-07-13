$(document).ready(function() {
    if (Modernizr.mq("all and (max-width: 480px)")) {
        $("[data-media-maxwidth480]").each(function() {
            var currentImage = $(this);
            var newImage = new Image();
            newImage.src = $(this).data("media-maxwidth480");
            newImage.onload = function() {
                currentImage.attr({
                    "src": newImage.src,
                    "width": newImage.width,
                    "height": newImage.height
                });
            }
        });
    }
});

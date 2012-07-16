$(document).ready(function() {
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
    $(window).hashchange(function(e) {
        if ("" != location.hash) {
            $(location.hash).trigger("scrollTo");
        } else {
            $.smoothScroll(0);
        }
    });
});

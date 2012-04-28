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
});

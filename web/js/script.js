// Preserve the original jQuery Mobile navigation and news interactions.
$(document).on("mobileinit", function () {
    if (location.protocol === "file:") {
        $.mobile.ajaxEnabled = false;
    }
});

$(document).on("pagebeforeshow", function () {
    var newslibtn = $.mobile.activePage.find(".newslibtn");
    newslibtn.siblings().slice(6).hide();
    newslibtn.find("a").text("Older News");
    newslibtn.find("span").toggleClass("ui-icon-plus", true).toggleClass("ui-icon-minus", false);
    sizeNavigation();
});

// Keep the original sidebar bottom spacing without the unused sponsor ticker.
function sizeNavigation() {
    if ($.mobile.activePage) {
        $.mobile.activePage.find(".leftnav").css("padding-bottom", 1.25 * ($(window).height() / 12 + 30) + "px");
    }
}
$(window).on("resize", sizeNavigation);

$(document).on("pageshow", function () {
    var content = $.mobile.activePage.find(".ui-content");
    content.css("min-height", content.height());
});

$(document).on("click", "#menu-toggle", function (event) {
    event.preventDefault();
    $.mobile.silentScroll($.mobile.activePage.find(".leftnav").position().top);
});

function showall() {
    var newslibtn = $.mobile.activePage.find(".newslibtn");
    newslibtn.find("span").toggleClass("ui-icon-plus ui-icon-minus");
    if (newslibtn.find("span").hasClass("ui-icon-minus")) {
        newslibtn.siblings().show();
        newslibtn.find("a").text("Hide Older News");
    } else {
        newslibtn.siblings().slice(6).hide();
        newslibtn.find("a").text("Older News");
    }
}

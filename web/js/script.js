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
    $.mobile.activePage.find("#navigation").removeClass("nav-open");
    $.mobile.activePage.find("#menu-toggle").attr("aria-expanded", "false");
    $.mobile.activePage.find(".nav-dropdown").prop("open", false);
});

$(document).on("pageshow", function () {
    var content = $.mobile.activePage.find(".ui-content");
    content.css("min-height", content.height());
});

$(document).on("click", "#menu-toggle", function (event) {
    event.preventDefault();
    var nav = $.mobile.activePage ? $.mobile.activePage.find("#navigation") : $("#navigation");
    nav.toggleClass("nav-open");
    $(this).attr("aria-expanded", nav.hasClass("nav-open") ? "true" : "false");
    if (!nav.hasClass("nav-open")) {
        nav.find(".nav-dropdown").prop("open", false);
    }
});

$(document).on("click", function (event) {
    if (!$(event.target).closest(".nav-dropdown").length) {
        $(".nav-dropdown[open]").prop("open", false);
    }
});

$(document).on("keydown", function (event) {
    if (event.key === "Escape") {
        var dropdown = $(".ui-page-active .nav-dropdown[open]");
        if (dropdown.length) {
            if (dropdown.has(document.activeElement).length) {
                dropdown.children("summary").trigger("focus");
            }
            dropdown.prop("open", false);
            event.preventDefault();
        }
    }
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

$(document).ready(run);

function run() {
    var SCROLL_TIME = 1000;

    if (window.location.href.search('price-list') == -1) {
        $(".scroll").click(menuClick);
    }

    function menuClick(event) {
        event.preventDefault();
        var id = '#' + $(this).attr("href").replace(/\.\/#/, '');
        $("html, body").animate({
            "scrollTop": $(id).offset().top - 100
        }, SCROLL_TIME);
    }
}
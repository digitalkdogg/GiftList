$(document).ready(function() {
    // Mouse Enter Animation Mechanism
$("#menu a").mouseenter(function () {
        $(this).switchClass("style1", "style2", 700);
    });
// Mouse Leave Animation Mechanism
$("#menu a").mouseleave(function () {
        $(this).switchClass("style2", "style1", 100);
    });
});
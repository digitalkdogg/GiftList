// JavaScript Document
$(document).ready(function() {
    // Mouse Enter Animation Mechanism
$(".gift_button").mouseenter(function () {
		$(this).find('.email').switchClass("email", "email_style2", 700);
		$(this).find('.btn_text').switchClass("btn_text", "btn_text_style2", 700);
    });
// Mouse Leave Animation Mechanism
$(".gift_button").mouseleave(function () {
        $('.email_style2').switchClass("email_style2", "email", 100);
		$('.btn_text_style2').switchClass("btn_text_style2", "btn_text", 100);
    });
});

// JavaScript Document
$(document).ready(function() {
	$('.gift_status').mouseenter(function () {
		$(this).animate({color: "#e4f0e5"}, 700);
	});
	$('.gift_status').mouseleave(function () {
		$(this).animate({color: "white"}, 100);
	});
});
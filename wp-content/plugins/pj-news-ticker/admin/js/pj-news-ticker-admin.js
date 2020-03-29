
jQuery(document).ready(function($){
    $('.color-field').wpColorPicker();

	$("#pjnt-shortcode-help").hide();
	$("#pjnt-shortcode-help-hide").hide();
	$("#pjnt-shortcode-help-show").click(function(){
	    $("#pjnt-shortcode-help").show();
	    $("#pjnt-shortcode-help-show").hide();
	    $("#pjnt-shortcode-help-hide").show();
	});
	$("#pjnt-shortcode-help-hide").click(function(){
	    $("#pjnt-shortcode-help").hide();
	    $("#pjnt-shortcode-help-show").show();
	    $("#pjnt-shortcode-help-hide").hide();
	});
});

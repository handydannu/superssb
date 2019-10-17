$(document).ready(function() {
    jQuery("#formID").validationEngine();

    $('input#title').change(function(){
		$('#title').friendurl({id : 'slug'});
	});
	$('input#title').keyup(function(){
		$('#title').friendurl({id : 'slug'});
	});
});
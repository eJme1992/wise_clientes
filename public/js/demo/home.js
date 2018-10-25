jQuery(function(){

    var btn_cc = 'btn-primary';
    var navbar_cc = 'cm-navbar-primary';


    jQuery('#demo-buttons button').click(function(){
	var color = jQuery(this).data('switch-color');
	jQuery('.cm-navbar').removeClass(navbar_cc);
	navbar_cc = 'cm-navbar-' + color;
	jQuery('.cm-navbar').addClass(navbar_cc);
	jQuery('.cm-navbar .btn').removeClass(btn_cc);
	btn_cc = 'btn-' + color;
	jQuery('.cm-navbar .btn').addClass(btn_cc);
    });














});

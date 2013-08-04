<?php
/*
Plugin Name: TOPS MDB Database Registration Form Shortcode
Plugin URI: https://github.com/marclijour/TOPSMDB-bridge
Description: A registration form for TOPS website. Usage: <code>[contact email="your@email.address"]</code>
Version: 1.0
Author: Vinoth Sabanadesan
Author URI: http://www.sabanadesan.com
*/
 
function tops_registration_form_sc( $atts ) {
 	$web_form ='<form name="addForm" method="get"  action="/TOPS/admin/AddUserServlet" onsubmit="return validateForm()">
	
	<span class="label">Login</span><span class="asterisk">(*)</span><input class="addform" type="text" name="login"/>';
	
	if($sent == true) {
		return $info;
	} else {
		return $web_form;
	}
 
}
add_shortcode( 'tops-register', 'tops_registration_form_sc' );
 
?>
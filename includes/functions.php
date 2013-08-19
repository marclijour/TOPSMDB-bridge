<?php

/******************************
 * SHORTCODES
 ******************************/
// [emailform]
function topsmdbb_shortcode_form_email( $atts ) {	
	ob_start(); // capture output and converts it to a string to return
	?>
<div id="dialog-form" title="Register to TOPS">
  <p class="validateTips">Enter your OPS email address.</p>
 
  <form>
<!--   <fieldset>
    <label for="email">Email</label> -->
    <input type="text" name="email" id="email" value="" class="text ui-widget-content ui-corner-all" />
<!--  </fieldset> -->
  </form>
</div>
<button id="register-user">Register</button>
	<?php
	$output_string = ob_get_contents();
	ob_end_clean();
	return $output_string ;
}
add_shortcode('emailform', 'topsmdbb_shortcode_form_email');

// [member form]
function topsmdbb_shortcode_form_member( $atts ) {
	ob_start(); // capture output and converts it to a string to return
	?>
<div id="memberform" title="Register to TOPS">
  <p class="validateTips">Enter your OPS information address.</p>
 
  <form action="" method="post">
	<label for="firstname">First Name</label>
    <input type="text" name="firstname" id="firstname" value="" class="text ui-widget-content ui-corner-all" />
    
	<br/>

	<label for="lastname">Last Name</label>
    <input type="text" name="lastname" id="lastname" value="" class="text ui-widget-content ui-corner-all" />
	
	<br/>
	
	<label for="jobtitle">Job Title</label>
    <input type="text" name="jobtitle" id="jobtitle" value="" class="text ui-widget-content ui-corner-all" />

	<br/>
	
    <label for="email">Email</label> 
    <input type="text" name="email" id="email" value="" class="text ui-widget-content ui-corner-all" />
	
	<input type="submit" value="Submit">
  </form>
</div>

	<?php
	$output_string = ob_get_contents();
	ob_end_clean();
	return $output_string ;
}

add_shortcode('memberform', 'topsmdbb_shortcode_form_member');

add_action('init', 'process_post');

function add_member($firstname, $lastname, $email){
		global $topsmdbb_TOPSMDB_URL;
		$url = $topsmdbb_TOPSMDB_URL.'AddMemberServlet';
		
		$fields = array(
			'firstname' => $firstname,
			'lastname' => $lastname,
			'email' => $email
		);
		//url-ify the data for the POST
		foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
		rtrim($fields_string, '&');
		$cookie="cookie.txt"; 
		//open connection
		$ch = curl_init();

		//set the url, number of POST vars, POST data
		curl_setopt($ch,CURLOPT_URL, $url);
		
		curl_setopt($ch,CURLOPT_POST, count($fields));
		curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
		
		curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
		curl_setopt ($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6"); 
		curl_setopt ($ch, CURLOPT_TIMEOUT, 60); 
		curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 0); 
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt ($ch, CURLOPT_COOKIEFILE, $cookie);
		curl_setopt ($ch, CURLOPT_REFERER, $url); 


		$result = curl_exec($ch);

		//close connection
		curl_close($ch);
		
		echo $result;
}

function process_post(){
	global $topsmddb_USER;
	global $topsmddb_PASSWORD;
	
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		//set POST variables
		global $topsmdbb_TOPSMDB_URL;
		$url = $topsmdbb_TOPSMDB_URL.'do/login/CheckLoginCredentialsServlet';
		$fields = array(
			'un' => urlencode($topsmddb_USER),
			'pw' => urlencode($topsmddb_PASSWORD)
		);
		//url-ify the data for the POST
		foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
		rtrim($fields_string, '&');
		$cookie="cookie.txt"; 
		//open connection
		$ch = curl_init();

		//set the url, number of POST vars, POST data
		curl_setopt($ch,CURLOPT_URL, $url);
		
		curl_setopt($ch,CURLOPT_POST, count($fields));
		curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
		
		curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
		curl_setopt ($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6"); 
		curl_setopt ($ch, CURLOPT_TIMEOUT, 60); 
		curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 0); 
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt ($ch, CURLOPT_COOKIEJAR, $cookie); 
		curl_setopt ($ch, CURLOPT_REFERER, $url); 


		$result = curl_exec($ch);

		//close connection
		curl_close($ch);
		
		if ($result == $topsmddb_USER){
			add_member($_POST["firstname"], $_POST["lastname"], $_POST["email"]);
		}
		else
		{
			echo "Error";
		}
	}
}

?>


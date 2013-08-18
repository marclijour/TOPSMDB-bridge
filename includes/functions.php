<!-- 
    Copyright 2013 Marc Lijour
    This file is part of TOPSMDB-bridge.

    TOPSMDB is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.
  
    TOPSMDB is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
-->
<?php

/******************************
 * SHORTCODES
 ******************************/
// [emailform]
function topsmdbb_shortcode_form_email( $atts ) {
	ob_start(); // capture output and converts it to a string to return
	?>
<script type="text/javascript">
    var itsapi = "MATH";
</script>
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






?>


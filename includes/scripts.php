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

// load CSSS
function topsmdbb_load_scripts() {

#	if(is_singular()) {
		#wp_enqueue_style('topsmdbb-styles', plugin_dir_url( __FILE__ ) . 'css/tops.css');


	###
	### Dependencies for modal popup (see http://jqueryui.com/dialog/#modal-form)
	###
		# Two styles needed to skin the popup
		wp_enqueue_style(  'topsmdbb-styles-popup', plugin_dir_url( __FILE__ ) . 'css/tops-popup.css');
		wp_enqueue_style(  'jquery-ui-smoothness', 'http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css');

		# Dependencies libraries & JS code
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'jquery-ui-dialog' );
		wp_enqueue_script( 'topsmdbb-script-email-popup', plugin_dir_url( __FILE__ ) . 'js/email-popup.js?itsapi=' . $ITS_API);

#	}
}
add_action('wp_enqueue_scripts', 'topsmdbb_load_scripts');



?>


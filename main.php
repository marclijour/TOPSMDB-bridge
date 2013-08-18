<!-- 
    Copyright 2013 Marc Lijour
    This file is part of TOPSMDB.

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
/*
Plugin Name: TOPSMDB-bridge
Plugin URI: https://github.com/marclijour/TOPSMDB-bridge
Description: API bridge between TOPS Intranet and TOPSMDB, the TOPS membership database management webapp.
Author: Marc Lijour (2013)
Author URI: http://about.me/marclijour
Version: 1.0
*/ 

/************************
 * GLOBAL VARIABLES
 ************************/
$topsmdbb_TOPSMDB_URL 	= "https://www.lijour.net/TOPStesting/"; ## TODO change for Prod

/************************
 * INCLUDES
 ************************/
include('includes/topsmdb-credentials.php');	// login info (not provided in GitHub)
include('includes/scripts.php');		// all JS and CSS
include('includes/functions.php');		// PHP functions for this plugin




?>


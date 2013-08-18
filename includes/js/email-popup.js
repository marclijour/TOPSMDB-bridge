/*
   Copyright 2013 Marc Lijour for modification to sample code at http://jqueryui.com/dialog/#modal-form
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
*/
// see http://jqueryui.com/dialog/#modal-form (and convert to no-conflict mode
  jQuery(function() {
    var email = jQuery( "#email" ),
	 allFields = jQuery( [] ).add( email ),
      tips = jQuery( ".validateTips" ),
      orgtipstext = tips.text();
 
    function updateTips( t ) {
      tips
        .text( t )
        .addClass( "ui-state-highlight" );
      setTimeout(function() {
        tips.removeClass( "ui-state-highlight", 1500 );
      }, 500 );
    }
 
    function checkLength( o, n, min, max ) {
      if ( o.val().length > max || o.val().length < min ) {
        o.addClass( "ui-state-error" );
        updateTips( "Length of " + n + " must be between " +
          min + " and " + max + "." );
        return false;
      } else {
        return true;
      }
    }
 
    function checkRegexp( o, regexp, n ) {
      if ( !( regexp.test( o.val() ) ) ) {
        o.addClass( "ui-state-error" );
        updateTips( n );
        return false;
      } else {
        return true;
      }
    }

    jQuery( "#dialog-form" ).dialog({
      autoOpen: false,
      height: 200,
      width: 400,
      modal: true,
      buttons: {
        "Register": function() {
          var bValid = true;
          allFields.removeClass( "ui-state-error" );
          
	  bValid = bValid && checkLength( email, "email", 6, 80 );
 
          // From jquery.validate.js (by joern), contributed by Scott Gonzalez: http://projects.scottsplayground.com/email_address_validation/
          bValid = bValid && checkRegexp( email, /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i, "eg. ui@jquery.com" );
	  bValid = bValid && checkRegexp( email, /ontario\.ca$/i, "Submit your OPS email address, e.g. firstname.lastname@ontario.ca");
  
          if ( bValid ) {
		alert("OK. Registering user with email=" + email.val());


		/*
		 * Call to TOPSMBD via local proxy (in PHP)
		 * TODO wrap this in another adapter eventually pointing to local database once fully migrated
		 * TODO call to ITS API to get full data
		 */
		jQuery.ajax({
    			url:"/tops/wp-content/plugins/TOPSMDB-bridge/includes/proxy.php?url=https%3A%2F%2Fwww.lijour.net%2FTOPStesting%2FAPI%2FIsMember",
			data: {email: email.val()},
    			type:'GET',
    			dataType:"json",
    			success:function(member){
				alert("Already member: " + member.found); 
				console.log(member);

				if( member.found ) {
					alert('Lucky you, you are already a member! Now check that you have an account in OPSpedia, or let us do make one for you... .TODO');
					// the rest of the story to be implemented by or with OPSpedia core team

				} else {
					// TODO remove this part and just insert the API at the (*) insertion point (and save a step), or
					// add a file named includes/itsapi.php returning the API URL to query ITS GAL (not provided in GitHub)
					jQuery.ajax({
					  url: "/tops/wp-content/plugins/TOPSMDB-bridge/includes/itsapi.php", // call API URL stored in local file
					  type: 'GET',
					  success: function(URL) {	// use this URL to call the API

					  // fetch member info from GAL
					  jQuery.ajax({
						url: URL + email.val(), // construct API call
    						type:'GET',
						success: function(galentry){
							alert(galentry);

							// TODO galentry most likely requires some parsing (strip 'callback'....
							

							// Let's register the member to TOPSMDB
							jQuery.ajax({
								url:"https://www.lijour.net/TOPStesting/",
								data: galentry,
	    							type:'GET',
								success: function(data){alert(data);}
							});
						},
						error: function(){alert("Error. Let's move to a manual process?... contact admin?");}
					  });
					 }
					});
					

				}
			}
		});

            	jQuery( this ).dialog( "close" );
		tips.text(orgtipstext);
          }
        },
        Cancel: function() {
          jQuery( this ).dialog( "close" );
	  tips.text(orgtipstext);
        }
      },
      close: function() {
        allFields.val( "" ).removeClass( "ui-state-error" );
      }
    });
 
    jQuery( "#register-user" )
      .button()
      .click(function() {
        jQuery( "#dialog-form" ).dialog( "open" );
      });
  });


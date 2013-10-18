<?php


/*

We used this script to migrate from a set of custom fields that contained 1st Name, 2nd Name, Phone No. and so on to one combined field
as it is used in the LDAP Autocomplete plugin.

Beware: Field IDs are hard coded!!!!

The script must be placed into the mantis root folder and executed by the browser.

Do not forget to delete it after use.

*/




# where to copy the data to
$destination_field_id =  79;

# list of source fields; the source fields are hard coded below in the if's again !!!!!!
$current_field_id = "1,2,3,4,24";
## do not forget to change below as well!




### START OF THE SCRIPT
require_once( 'core.php' );

require_once('custom_field_api.php');

auth_reauthenticate();

set_time_limit(900);

ob_end_flush();


## COUNTDOWN does not work (flush) no idea why?

/*
#countdown
echo "DO NOT RUN THIS SCRIPT TWICE - YOU WOULD HAVE AN ADDITIONAL LOG ENTRY IN THE HISTORY<br>\n";
echo " 10 seconds delay ... (close the browser might stop the script now)<br>\n";
flush();
sleep(5);
echo " 5 seconds delay ... <br>\n";
flush();
sleep(5);
echo "starting<br>\n";
flush();

exit();
*/

#go!
$mysql = mysql_query("SELECT * FROM `mantis_custom_field_string_table` where field_id IN($current_field_id) order by `bug_id`");
if( $mysql) {
	$start = true;
	$i=1;
	while ( $rows= mysql_fetch_array($mysql)) {
		$field_id = $rows['field_id'];
		$bug = $rows['bug_id'];
		$results = $rows['value'];

		if ( $field_id == 1) {
				
			$fname = $results."\n";
				
		}
		if ( $field_id == 2) {

			$sname = $results."\n";
		}
		if ( $field_id == 24) {

			$email = "- E: ".$results."\n";
		}
		if ( $field_id == 3) {
			$extension = "- P: ".$results."\n";
		}
		if ( $field_id == 4) {
			$mobile = "- M: ".$results."\n";
		}
		if ($field_id == 0) {
			$start = true;
		}
		if ( $i == 5) {
			$i=1;
			$value = $fname.$sname.$email.$extension.$mobile;
			custom_field_set_value($destination_field_id, $bug, $value);
				
			echo "#". $bug . " migrated<br>\n";
		}else{
			
			$i++;
		}
	}
}



<?php
define( 'CUSTOM_FIELD_TYPE_LDAP', 25 );
require_once('LDAPAutocomplete.php');

// this function should never be called
function ldap_autocomplete_dummy_function($l_field_def, $l_custom_field_value) {
#	die(__FILE__ . ':'. __LINE__ . ' ERROR! You need the custom field event patches!');
}

function cfdef_prepare_ldapautocomplete_value( $p_value) {
	echo $p_value;
}


<?php


auth_get_current_user_id();
$username = gpc_get('term');//cn =>sAMAccountName
$ldap_dn  = plugin_config_get('ldapauto_ldap_dn');
$base_dn  = plugin_config_get('ldapauto_base_dn');
$ldappass = plugin_config_get('ldapauto_password');

$ldapserver = plugin_config_get('ldapauto_host');
ldap_set_option(NULL, LDAP_OPT_DEBUG_LEVEL, 7);
$ldapconn = ldap_connect($ldapserver)
or die("Could not connect to LDAP server.");

if ($ldapconn) {

	ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);
	ldap_set_option($ldapconn, LDAP_OPT_REFERRALS, 0);
	$ldapbind = ldap_bind($ldapconn, $ldap_dn, $ldappass);
	$filter = "(& (objectClass=Person)(| (sn=$username*)(givenname=$username*)))";

	$ldapsearch = ldap_search ($ldapconn, $base_dn, $filter );

	$entries = ldap_get_entries($ldapconn, $ldapsearch);
	# FIXME THIS NEED ADDITIONAL CONFIGURATION

	$format = plugin_config_get('ldapauto_attribute');

	for ( $i = 0 ;  $i < $entries['count']; $i++ ) {
		if ($i < plugin_config_get('ldapauto_maxrow') ) {
		$result = $format."\n";
			
			foreach($entries[$i] as $key => $entrie) {
					
				if ( is_string($key) ) {
					$result = str_replace('{'.$key.'}', $entrie[0], $result);
				}
			}
		$contact_data[] = $result;
		}
	}
}
print json_encode($contact_data);

?>

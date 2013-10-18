<?php
auth_reauthenticate();
access_ensure_global_level( config_get( 'manage_plugin_threshold' ) );

$f_ldap_host			= gpc_get_string('ldapauto_host');
$f_ldap_base_dn			= gpc_get_string('ldapauto_base_dn');
$f_ldap_dn				= gpc_get_string('ldapauto_ldap_dn');
$f_ldap_password		= gpc_get_string('ldapauto_password');
$f_ldap_textlength		= gpc_get_int('ldapauto_textlength');
$f_ldap_maxrow			= gpc_get_int('ldapauto_maxrow');
$f_ldap_attribute		= gpc_get_string('ldapauto_attribute');


	
plugin_config_set('ldapauto_host'					,$f_ldap_host);
plugin_config_set('ldapauto_base_dn'				,$f_ldap_base_dn);
plugin_config_set('ldapauto_ldap_dn'				,$f_ldap_dn);	
plugin_config_set('ldapauto_password'				,$f_ldap_password);	
plugin_config_set('ldapauto_textlength'				,$f_ldap_textlength);
plugin_config_set('ldapauto_maxrow'					,$f_ldap_maxrow);
plugin_config_set('ldapauto_attribute'				,$f_ldap_attribute);


print_successful_redirect( plugin_page( 'config',TRUE ) );





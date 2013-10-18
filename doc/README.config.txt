Introduction:
LDAPAutocomplete is an input custom field to enable users quickly finding 
and selecting user contact information from LDAP Server('Activate Directory').

By giving an autocompleted field focus or entering something into it, the 
plugin starts searching for matching entries and displays a list of user contact 
from an LDAP Server.

Installation:
This plugin is dependent on JQuery plugin so make sure you install JQuery plugin. 
And then install the LDAPAutocomplete plugin. Other you need to merge with patch:0011473 this necessary 
for adding new custom field type via a plugin. 

Configuration:
After installing LDAPAutocomplete set the following field on LDAPAutocomplete config page.
Hostname ="your ldap host name" // Eg: ldap://servername.hostname.com: port #no
BASE_DN: "write the base dn of your ldap server"
LDAP_DN: "on ldap_dn include your user name" Eg: uid=username, ou: system
Password: " Your ldap password".
Maximum text length for searching: "max string for searching"
Maximum rows for dropdown list: "max row displayed on the list box".
Format strings: this will replace the ldap default attribure.











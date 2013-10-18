<?php
# Copyright (C) 2009 John Reese, LeetCode.net
#
# This program is free software: you can redistribute it and/or modify
# it under the terms of the GNU Affero General Public License as published by
# the Free Software Foundation, either version 3 of the License, or
# (at your option) any later version.
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU Affero General Public License for more details.


/**
 *  A method that populates the plugin information and minimum requirements.
 */
class LDAPAutocompletePlugin extends MantisPlugin {

	function register() {
		$this->name = plugin_lang_get('name');
		$this->description = plugin_lang_get('description');

		$this->version = '0.1';
		$this->requires = array(
			'MantisCore' => '1.2',
		     'jQuery' =>'1.4'
			
		     );

		$this->author = 'GTZ Ethiopia ICT Service - Development Team';         # Author/team name
		$this->contact = 'ict-et@gtz.de?subject=Mantis Plugin '.$this->name.' '.$this->version;        # Author/team e-mail address
		$this->url = '';            # Support webpage
		$this->page			= 'config';
	}
	/**
	 * LDAPAutocomplete plugin hooks.
	 */

	function hooks() {
		return array(
			'EVENT_LAYOUT_RESOURCES' => 'resource',
			'EVENT_CUSTOM_FIELD_DEFS' => 'ldap_defination',
			'EVENT_LANG_GET'	=>	'lang_get',
			'EVENT_CUSTOM_FIELD_PRINT_INPUT' => 'autocomplete_input',
			'EVENT_PLUGIN_INIT' => 	'init'
		);
	}
	/**
	 * LDAPAutocomplete plugin configuration.
	 */
	function config() {
		return array(
        	'ldapauto_host'       => "",
        	'ldapauto_base_dn'    => "",
        	'ldapauto_ldap_dn'    => "",
        	'ldapauto_password'   => "",
			'ldapauto_textlength' => 1,
			'ldapauto_maxrow'	  => 10,
        	'ldapauto_attribute'  => "{cn} - M: {mail} - P: {telephonenumber} - M: {mobile}",
		);
	}
	/**
	 * Create the ldap_autocomplete link to load the jquery-ui.min.js library.
	 */
	function resource( $p_event ) {
		$resource  = '';
		$resource .= '<link type="text/css" rel="stylesheet" href="' . plugin_file( 'jquery-ui.css' ) . '"></script>';
		$resource .= '<script type="text/javascript" src="' . plugin_file( 'jquery-ui-min.js' ) . '"></script>';
		
		return $resource;
	}
	
	/**
	 * load autocomplete script for dropdown input text field.
	 */
	function autocomplete_input($p_event, $l_field_def, $value) {
		if ($l_field_def["type"] != CUSTOM_FIELD_TYPE_LDAP) {
			return null;
		}

		echo '<script type="text/javascript">';
		echo 'jQuery(document).ready(function($){';
		echo	'$("#custom_field_'.$l_field_def['id'].'").autocomplete({';
		echo		'source: "'.plugin_page( 'ldap_search.php').'",';
		echo 		'minLength: "'.plugin_config_get('ldapauto_textlength').'",';
		echo		'select: function( event, ui ) {';
		echo		'}';
		echo	'});';
		echo '});';
		echo '</script>';
		echo '<input type="text" size="70" id="custom_field_'.$l_field_def['id'].'" name="custom_field_'.$l_field_def['id'].'" value ="'.$value.'">';
		return $value;
	}
	
	# include LDAPAutocomplete.API.php page
	function init(){
		require_once('LDAPAutocomplete.API.php');
	}
	/**
	 * @param $p_event connect the plugin function to mantis system
	 * @param $l_translation This will pass the plugin selected name.
	 * @param $l_string This variable hold the string type
	 * @param $l_lang This pass the language we give for specific plugin
	 * @return string This return the plugin name.
	 */
	function lang_get( $p_event, $l_translation, $l_string, $l_lang) {
		if ('custom_field_type_enum_string' == $l_string) {
			$l_translation = $l_translation.',' . CUSTOM_FIELD_TYPE_LDAP . ":" . plugin_lang_get("LDAP");
		}
		return $l_translation;
	}

	/**
	 * @param $parameter
	 * @param $g_custom_field_types pass the type of the plugin.
	 * @param $g_custom_field_type_enum_string This global defination of string language of the plugin.
	 *
	 * @param $g_custom_field_type_definition You can specific or define the values of the field in the array.
	 */

	function ldap_defination($parameter, $types) {
		global $g_custom_field_types;
		global $g_custom_field_type_definition;
		global $g_custom_field_type_enum_string, $s_custom_field_type_enum_string;

		# Avoid Conflicts with Other Plugins
		if (isset($g_custom_field_types[CUSTOM_FIELD_TYPE_LDAP])) {
			trigger_error( ERROR_PLUGIN_GENERIC, ERROR );
		}

		$g_custom_field_types[CUSTOM_FIELD_TYPE_LDAP] = 'LDAPAutocompletePlugin';

		$g_custom_field_type_definition[ CUSTOM_FIELD_TYPE_LDAP ] = array (
			'#display_possible_values' => TRUE,
			'#display_valid_regexp' => TRUE,
			'#display_length_min' => TRUE,
			'#display_length_max' => TRUE,
			'#display_default_value' => TRUE,
			'#special_field' => TRUE,
			'#function_return_distinct_values' => null,
			'#function_value_to_database' => null,
			'#function_database_to_value' => null,
			'#function_print_input' => 'ldap_autocomplete_dummy_function',
			'#function_string_value' => "cfdef_prepare_ldapautocomplete_value",
			'#function_string_value_for_email' => null,
		);

		$g_custom_field_type_enum_string.="," . CUSTOM_FIELD_TYPE_LDAP . ":LDAP";


	}
}






<?php
auth_reauthenticate();
access_ensure_global_level( config_get( 'manage_plugin_threshold' ) );
html_page_top1( plugin_lang_get( 'plugin_title' ) );
html_page_top2();
print_manage_menu();
?>

<br/>

<form action="<?php echo plugin_page( 'config_page.php' ) ?>" method="post">
<table align="center" class="width75" cellspacing="1">
<tr>
	<td class="form-title" colspan="5">
		<?php echo plugin_lang_get( 'plugin_title' ) . ': ' . plugin_lang_get( 'config' ) ?>
	</td>
</tr>

<tr <?php echo helper_alternate_class() ?> >
	<td class="category" width="60%">
		<?php echo plugin_lang_get( 'config_ldap_hostname' ) ?>
	</td>
	<td width="20%">
		<input name="ldapauto_host" size="30" value="<?php echo plugin_config_get('ldapauto_host')?>">
	</td>
</tr>
<tr <?php echo helper_alternate_class() ?> >
	<td class="category" width="60%">
		<?php echo plugin_lang_get( 'config_ldapauto_base_dn' ) ?>
	</td>
	<td width="20%">
		<input name="ldapauto_base_dn" size="30" value="<?php echo plugin_config_get('ldapauto_base_dn') ?>">
	</td>
</tr>

<tr <?php echo helper_alternate_class() ?> >
	<td class="category" width="60%">
		<?php echo plugin_lang_get( 'config_ldapauto_ldap_dn' ) ?>
	</td>
	<td width="20%">
		<input name="ldapauto_ldap_dn" size="30" value="<?php echo plugin_config_get('ldapauto_ldap_dn') ?>">
	</td>
</tr>

<tr <?php echo helper_alternate_class() ?> >
	<td class="category" width="60%">
		<?php echo plugin_lang_get( 'config_ldapauto_password' ) ?>
	</td>
	<td width="20%">
		<input name="ldapauto_password" size="30" value="<?php echo plugin_config_get('ldapauto_password') ?>">
	</td>
</tr>
<tr>
<tr <?php echo helper_alternate_class() ?> >
	<td class="category" width="60%">
		<?php echo plugin_lang_get( 'config_ldapauto_textlength' ) ?>
	</td>
	<td width="20%">
		<input name="ldapauto_textlength" size="4" value="<?php echo plugin_config_get('ldapauto_textlength') ?>">
	</td>
</tr>
<tr>
<tr <?php echo helper_alternate_class() ?> >
	<td class="category" width="60%">
		<?php echo plugin_lang_get( 'config_ldapauto_maxrow' ) ?>
	</td>
	<td width="20%">
		<input name="ldapauto_maxrow" size="4" value="<?php echo plugin_config_get('ldapauto_maxrow') ?>">
	</td>
</tr>
<tr <?php echo helper_alternate_class() ?> >
	<td class="category" width="60%">
		<?php echo plugin_lang_get( 'config_ldapauto_attribute' ) ?>
	</td>
	<td width="20%">
		<input name="ldapauto_attribute" size="30" value="<?php echo plugin_config_get('ldapauto_attribute')?>">
	</td>
</tr>
<tr>
	<td class="center" colspan="2">
		<input type="submit" class="button" value="<?php echo plugin_lang_get( 'update_config' ) ?>" />
	</td>
</tr>


</table>

</form>

<?php
html_page_bottom();
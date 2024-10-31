<?php // encoding: utf-8
/**
* Description: Creates database tables used by namesday
* Author: István Faur
*/
$filename = WP_PLUGIN_DIR.'/'.dirname(plugin_basename(__FILE__)).'/'.SQL_NAME;
//Create database tables needed by the namesday widget
$mod_table_struct = array("1.0");

function nameday_import_data() {
//http://stackoverflow.com/users/972501/vijin-paulraj
global $wpdb,$filename;
//echo $filename;
// Temporary variable, used to store current query
$templine = '';
// Read in entire file
$lines = file($filename);
// Loop through each line
foreach ($lines as $line)
{
// Skip it if it's a comment
if (substr($line, 0, 2) == '--' || $line == '' || $line == '/*')
continue;

// Add this line to the current segment
$templine .= $line;
// If it has a semicolon at the end, it's the end of the query
if (substr(trim($line), -1, 1) == ';')
{
// Perform the query
$wpdb->query($templine);
// or print('Error performing query \'<strong>' . $templine . '\': ' . mysql_error() . '<br /><br />');
// Reset temp variable to empty
$templine = '';
}
}
}

function nameday_db_create(){
//Get the table name with the WP database prefix
global $wpdb;
global $mod_table_struct;
$options = get_option('Nameday');
if(isset($options['nameday_db_table_version'])){
$installed_ver = $options['nameday_db_table_version'];
} else 	{
$installed_ver = "1.0";
}
 //Check if the table already exists and if the table is up to date, if not create it
if($wpdb->get_var(("SHOW TABLES LIKE '".NAMEDAY_TABLE_NAME."'") != NAMEDAY_TABLE_NAME)
		||  ($installed_ver != NAMEDAY_TABLE_VERSION )) {
		if(in_array($installed_ver, $mod_table_struct, TRUE)){
			$sql="DROP TABLE IF EXISTS ".NAMEDAY_TABLE_NAME;
			$wpdb->query($sql);
		}
	nameday_import_data();
	$options['nameday_db_table_version'] = NAMEDAY_TABLE_VERSION;
	update_option('Nameday' , $options);
}
}
?>
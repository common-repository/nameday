<?php // encoding: utf-8
/*
Plugin Name: Nameday
Plugin URI: http://nameday.castorlandbt.eu/
Description: The plugin (widget) displays the current (and optionally tomorrow's) name-day(s).
Author: István Faur
Version: 1.3
Author URI: http://nameday.castorlandbt.eu/
Tags: multilingual, multi, language, name, widget, nameday
*/
/*
Installed name-days are: Austrian, German, French, Swedish, Italian, English, Spanish, Polish, Czech and Slovak.
*/
/*
Most flags in flags directory are made by Luc Balemans and downloaded from
FOTW Flags Of The World website at http://flagspot.net/flags/
(http://www.crwflags.com/FOTW/FLAGS/wflags.html)
*/
/*
tooltips.js from css-tricks.com/exampes/CSSTooltips.zip
*/
/*  Copyright 2012 István Faur  (email : ifaur@gmail.hu)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
/*
Specials thanks
===============
All Supporters! Thanks for all the gifts, cards and donations!

*/
//error_reporting(E_ALL);
// sets default language
//http://www.openscriptsolution.com/2009/09/14/how-to-detect-default-client-s-browser-language-using-php/

$prefered_languages = array();
if(preg_match_all("#([^;,]+)(;[^,0-9]*([0-9\.]+)[^,]*)?#i",
$_SERVER["HTTP_ACCEPT_LANGUAGE"],
$matches,
PREG_SET_ORDER)) {
$priority = 1.0;
foreach($matches as $match) {
  if(!isset($match[3])) {
	$pr = $priority;
	$priority -= 0.001;
  } else {
	$pr = floatval($match[3]);
  }
  $prefered_languages[$match[1]] = $pr;
}
arsort($prefered_languages, SORT_NUMERIC);
foreach($prefered_languages as $language => $priority) {
  $nameday_config['prefered_language'][]=$language;
}
}

$nameday_config['default_language'] = 'en_US';

if(WPLANG!=''){
$pos = strpos(WPLANG, '_');
//$nyelv=substr(WPLANG, 0, $pos);)
$nyelv=strtolower(substr(WPLANG, ($pos+1)));
} else {
$nyelv=$nameday_config['default_language'];
}

$origin_nyelv=$nyelv;

$nameday_config['language_name']['de_AT'] = "Austrian";
$nameday_config['language_name']['de_DE'] = "Deutsch";
$nameday_config['language_name']['en_GB'] = "English";
$nameday_config['language_name']['fr_FR'] = "Français";
$nameday_config['language_name']['nl_NL'] = "Nederlands";
$nameday_config['language_name']['sv_SE'] = "Svenska";
$nameday_config['language_name']['it_IT'] = "Italiano";
$nameday_config['language_name']['ro_RO'] = "Română";
$nameday_config['language_name']['hu_HU'] = "Magyar";
$nameday_config['language_name']['es_ES'] = "Español";
$nameday_config['language_name']['pt_PT'] = "Português";
$nameday_config['language_name']['pl_PL'] = "Polski";
$nameday_config['language_name']['cs_CZ'] = "Čechy";
$nameday_config['language_name']['sk_SK'] = "Slovak";
$nameday_config['language_name']['en_US'] = "American";
$nameday_config['language_name']['fi_FI'] = "Finish";
$nameday_config['language_name']['el_EL'] = "Greek";
$nameday_config['language_name']['fr_CH'] = "Switzerland";
$nameday_config['language_name']['de_CH'] = "Switzerland";


// Flag images configuration
// Look in /flags/ directory for a huge list of flags for usage
$nameday_config['flag']['de_AT'] = 'at.png';
$nameday_config['flag']['en_GB'] = 'gb.png';
$nameday_config['flag']['de_DE'] = 'de.png';
$nameday_config['flag']['fr_FR'] = 'fr.png';
$nameday_config['flag']['nl_NL'] = 'nl.png';
$nameday_config['flag']['sv_SE'] = 'se.png';
$nameday_config['flag']['it_IT'] = 'it.png';
$nameday_config['flag']['ro_RO'] = 'ro.png';
$nameday_config['flag']['hu_HU'] = 'hu.png';
$nameday_config['flag']['es_ES'] = 'es.png';
$nameday_config['flag']['pt_PT'] = 'br.png';
$nameday_config['flag']['pl_PL'] = 'pl.png';
$nameday_config['flag']['cs_CZ'] = 'cz.png';
$nameday_config['flag']['sk_SK'] = 'sk.png';
$nameday_config['flag']['en_US'] = "us.png";
$nameday_config['flag']['fi_FI'] = "fi.png";
$nameday_config['flag']['el_EL'] = "gr.png";
$nameday_config['flag']['fr_CH'] = "ch.png";
$nameday_config['flag']['de_CH'] = "ch.png";

// Location of flags
$nameday_config['flag_location'] = 'plugins/nameday/flags/';

// Location of images
$nameday_config['images'] = 'plugins/nameday/images/';

$os = getenv('OS');
$nameday_config['date_format']['hu_HU']="%Y-%m-%d %A";
if (preg_match ("/windows/i", $os)) {
$nameday_config['date_format']['de_AT'] = '%A, der %#d. %B %Y';
$nameday_config['date_format']['de_DE'] = '%A, der %#d. %B %Y';
$nameday_config['date_format']['fr_FR'] = '%A %#d %B %Y';
$nameday_config['date_format']['ro_RO'] = '%A, %#d %B %Y';
$nameday_config['date_format']['en_GB'] = '%A %B %#d, %Y';
$nameday_config['date_format']['en_US'] = '%A %B %#d, %Y';
$nameday_config['date_format']['de_CH'] = '%A, der %#d. %B %Y';
$nameday_config['date_format']['fr_CH'] = '%A %#d %B %Y';
} else {
$nameday_config['date_format']['de_AT'] = '%A, der %d. %B %Y';
$nameday_config['date_format']['de_DE'] = '%A, der %d. %B %Y';
$nameday_config['date_format']['fr_FR'] = '%A %e %B %Y';
$nameday_config['date_format']['ro_RO'] = '%A, %e %B %Y';
$nameday_config['date_format']['en_GB'] = '%A %B %e, %Y';
$nameday_config['date_format']['en_US'] = '%A %B %e, %Y';
$nameday_config['date_format']['de_CH'] = '%A, der %d. %B %Y';
$nameday_config['date_format']['fr_CH'] = '%A %e %B %Y';
}

$nameday_config['date_format']['es_ES']="%A %d de %B de %Y";
$nameday_config['date_format']['it_IT']="%A ,%d/%m/%Y";
$nameday_config['date_format']['zh'] = '%x %A';
$nameday_config['date_format']['fi_FI'] = '%d.%m.%Y';
$nameday_config['date_format']['nl_NL'] = '%d/%m/%y';
$nameday_config['date_format']['sv_SE'] = '%Y/%m/%d';
$nameday_config['date_format']['vi'] = '%d/%m/%Y';
$nameday_config['date_format']['ar'] = '%d/%m/%Y';
$nameday_config['date_format']['pt_PT'] = '%d de %B de %Y';
$nameday_config['date_format']['pl_PL'] = '%d/%m/%y';
$nameday_config['date_format']['gl'] = '%d de %B de %Y';
$nameday_config['date_format']['sk_SK'] = '%d/%m/%y';
$nameday_config['date_format']['cs_CZ'] = '%d de %B de %Y';
$nameday_config['date_format']['el_EL'] = '%d/%m/%Y';

define( 'NAMEDAY_PATH', dirname( __FILE__ ) );
define( 'NAMEDAY_BASENAME', plugin_basename( __FILE__ ) );
define( 'NAMEDAY_BASEFOLDER', plugin_basename( dirname( __FILE__ ) ) );
define( 'NAMEDAY_FILENAME', str_replace( NAMEDAY_BASEFOLDER.'/', '', plugin_basename(__FILE__) ) );
define( 'NAMEDAY_LANG_DIR', plugin_basename( dirname( __FILE__ ) ).'/language' );
define( 'NAMEDAY_TABLE_NAME', $wpdb->prefix . "nameday");
define( 'SQL_NAME', $wpdb->prefix . "nameday.sql");
define( 'NAMEDAY_TABLE_VERSION', "1.3");

include_once("nameday_database.php");
include_once("google_translate.php");
//Activation hook so the DB is created when plugin is activated



function nameday_update_db_check() {
$options = get_option('Nameday');

if ((isset($options['nameday_db_table_version']) && ($options['nameday_db_table_version'] != NAMEDAY_TABLE_VERSION)) || (!isset($options['nameday_db_table_version']))) {
nameday_db_create();
}
nameday_data_tables_exist();
nameday_mo_file_exist();
}
add_action('plugins_loaded', 'nameday_update_db_check');

function nameday_init() {
load_plugin_textdomain('nameday', false, basename( dirname( __FILE__ ) ) . '/language/');

if (function_exists('load_plugin_textdomain')) {
  load_plugin_textdomain('nameday', WP_PLUGIN_DIR.'/'.dirname(plugin_basename(__FILE__)).'/language', dirname(plugin_basename(__FILE__)).'/language' );
}
}

function nameday_build_stylesheet_url() {
global $url;
$options = get_option('Nameday');
echo '<link rel="stylesheet" href="' . $url.'/wp-content/plugins/'.dirname(plugin_basename(__FILE__)).'/css/' . 'nameday.css?build=' . date( "Ymd", strtotime( '-24 days' ) ) . '" type="text/css" media="screen" />';
echo '<link rel="stylesheet" href="'. $url.'/wp-content/plugins/'.dirname(plugin_basename(__FILE__)).'/css/tooltips.css" type="text/css" media="screen" />';
echo '<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>';
if ($options['nameday_bubble'] == 'yes') {
echo '<!--[if !IE | (gt IE 8)]><!-->
<script src="'. $url.'/wp-content/plugins/'.dirname(plugin_basename(__FILE__)).'/js/tooltips.js"></script>';
echo '<script>
	jQuery(document).ready(function($) {
		$("#nev span[title]").tooltips();
	});
</script>
<!--<![endif]-->';
echo '<style>';
echo '.tooltip, .arrow:after {
		background: '.$options['nameday_bbgcolor1'].';}';
echo '.tooltip {
		color: '.$options['nameday_bbgcolor2'].'
}';
echo '</style>';
}
}

function nameday_build_stylesheet_content() {
if( isset( $_GET['build'] ) && addslashes( $_GET['build'] ) == date( "Ymd", strtotime( '-24 days' ) ) ) {
	header("Content-type: text/css");
	echo "/* Something */";
	define( 'DONOTCACHEPAGE', 1 ); // don't let wp-super-cache cache this page.
	die();
}
}

function nameday_customAdmin() {
$url = get_settings('siteurl');
$url = $url . '/wp-content/plugins/'.dirname(plugin_basename(__FILE__)).'/css/' . 'nameday.css?';
echo '<!-- custom admin css -->
	  <link rel="stylesheet" type="text/css" href="' . $url . '" />
	  <!-- /end custom adming css -->';
}

/**
* Generic function to show a message to the user using WP's
* standard CSS classes to make use of the already-defined
* message colour scheme.
*
* @param $message The message you want to tell the user.
* @param $errormsg If true, the message is an error, so use
* the red message style. If false, the message is a status
* message, so use the yellow information message style.
*/
function nameday_showMessage($message, $errormsg = false, $classtype = "updated fade")
{
if ($errormsg) {
	echo '<div id="message" class="error">';
}
else {
	echo '<div id="message" class="'.$classtype.'">';
}

echo "<p><strong>$message</strong></p></div>";
}
/**
* Just show our message (with possible checking if we only want
* to show message to certain users.
*/
function showAdminMessages($message, $errormsg = false)
{
// Only show to admins
if (!current_user_can('manage_options')) {
	 wp_die( __('You do not have sufficient permissions to access this page.') );
 }
   nameday_showMessage($message."You need to upgrade your database as soon as possible...");
}

//register_activation_hook(__FILE__,array('Nameday', 'nameday_db_create'));
//register_activation_hook(__FILE__,array('Nameday', 'nameday_import_data'));

//add_action('init', 'nameday_import_data');
//add_action('init', 'nameday_db_create');

add_action('admin_content', 'nameday_customAdmin');
add_action( 'init', 'nameday_build_stylesheet_content' );
add_action( 'wp_head', 'nameday_build_stylesheet_url' );
add_action('init', 'nameday_init');

register_activation_hook( __FILE__, array('Nameday', 'activate'));
register_deactivation_hook( __FILE__, array('Nameday', 'deactivate'));

function nameday_filter_plugin_meta($links, $file) {
$plugin = plugin_basename(__FILE__);
if ($file == $plugin) // only for this plugin
	return array_merge( $links,
		array( sprintf( '<a href="%s">%s</a>', menu_page_url( 'nameday', false ), __('Settings') ) ),
		array( '<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=JPTGSAZUSPTXW">' . __('Donate with PayPal', 'nameday') . '</a>' )
	);
return $links;
}

function nameday_filter_plugin_links($links, $file) {
$plugin = plugin_basename(__FILE__);
if ($file == $plugin) // only for this plugin
	return array_merge( $links,
		array( sprintf( '<a href="%s">%s</a>',  menu_page_url( 'nameday', false ), __('Settings') ) )
	);
return $links;
}

global $wp_version;
if ( version_compare( $wp_version, '3.4', '>' ) ){
add_filter( 'plugin_row_meta', 'nameday_filter_plugin_meta', 10, 2 ); // only 2.8 and higher
add_filter( 'plugin_action_links', 'nameday_filter_plugin_links', 10, 2 );
}

function nameday_Language($language){
global $nameday_config;
if(!in_array($language, $nameday_config['enabled_languages'], TRUE)) {
$language=$nameday_config['default_language'];
}
return $language;
}

function nameday_mo_file_exist(){
global $nameday_config;
$options = get_option('Nameday');
if(isset($options['installed_languages'])) {
$nameday_config['installed_languages']= $options['installed_languages'];
return true;
}
$k_nev = NAMEDAY_PATH."/language/";
$nameday_config['installed_languages'][] =$nameday_config['default_language'];
if (is_dir($k_nev)) {
if ($k_azon = @opendir($k_nev)) {
while (($file = readdir($k_azon)) !== false) {
 if ($file != "." && $file != ".."){
	$pos = strpos($file, '-');
	$state=substr($file, ($pos+1));
	$pos_p=strpos($state, '.');
	$l_state=substr($state, 0,$pos_p);
	if(substr($state, ($pos_p+1))=="mo"){
	$l_t=explode("-",$l_state);
//	$nameday_config['installed_languages'][] = $l_t[0];
	$l_state = str_replace('-','_',$l_state);
	$nameday_config['installed_languages'][] = $l_state;
	}
 }
}
}
closedir($k_azon);
} else nameday_showmessage(__('Dont reading .mo files!',nameday),true);
}

function nameday_data_tables_exist(){
global $wpdb,$nameday_config;
$table_name = NAMEDAY_TABLE_NAME;
$tables = $wpdb->get_results("SELECT DISTINCT CONCAT(nyelv,'_',orszag) FROM $table_name ORDER BY orszag ASC", ARRAY_N);
$i=0;
foreach ( $tables as $table )
{
 $pos = strpos($table[0], '_');
 $nyelv=substr($table[0], 0,$pos);
 $country=substr($table[0], ($pos+1));	
 $nameday_config['enabled_languages'][$i] = strtolower($nyelv).'_'.strtoupper($country);
 ++$i;
}
}

function nameday_shortcode( $atts ) {
global $wpdb,$nameday_config;
$options = get_option('Nameday');
extract( shortcode_atts( array(
	'nameday_date' => '',
	'nameday_lang' => '',
	'nameday_msg' => '',
	'color' => '',
	'max_name' => '',
	'date_format' => 'l, d F Y',
), $atts ) );
// get_the_time('d/m/Y', $post->ID)
$nameday_str = '';
if((!isset($nameday_lang) || $nameday_lang == '')){
if(isset($_GET['lang'])){
$nameday_lang = $_GET['lang'];
} elseif (WPLANG != ''){
$pos = strpos(WPLANG, '_');
$lang = substr(WPLANG, 0, $pos);
$nameday_lang = substr(WPLANG, ($pos+1));
}
} else {
$pos = strpos($nameday_lang, '_');
$lang = substr($nameday_lang, 0, $pos);
$nameday_lang = substr($nameday_lang, ($pos+1));
}
if(!isset($nameday_date) || empty($nameday_date)){
$nameday_date = getdate();
}
if(!isset($max_name) || empty($max_name)){
if(isset($options['nameday_maxname'])){
$max_name = (int)$options['nameday_maxname'];
} else {
$max_name = 2;
}
}
if(is_array($nameday_date)){
$month=$nameday_date['mon'];
$day=$nameday_date['mday'];
} elseif(is_string($nameday_date)){
$array_date = explode("/",$nameday_date);
$month = $array_date[1];
$day = $array_date[1];
}
if($wpdb->get_var("SHOW TABLES LIKE '".NAMEDAY_TABLE_NAME."'") == NAMEDAY_TABLE_NAME){
$namedays=$wpdb->get_row("SELECT nev1,nyelv,CONCAT(nyelv,'_',orszag) as locale FROM ".NAMEDAY_TABLE_NAME." WHERE ho=$month AND nap=$day and orszag=UPPER('$nameday_lang')",ARRAY_N);
}
if($wpdb->num_rows>0){
$lang = $namedays[1];
//$nyelvkod = $namedays[1].'_'.strtoupper($nameday_lang);
$nyelvkod = $namedays[2];
setlocale(LC_ALL, $nyelvkod.'UTF-8');
$nev_str = '';
$i=0;
if(isset($namedays)){
$nev = explode(',',$namedays[0]);
if(count($nev)>$max_name){
$title = array_slice($nev, $max_name);
$title_str = implode(",",$title);
$rednev = array_slice($nev, 0, $max_name);
$nev_str = implode(",",$rednev);
$bubble = '<span title="'.$title_str.'">...</span>';
} else {
$nev_str = implode(",",$nev);
}
$nameday_str = '<div class="box"';
if(isset($color) && !empty($color)){
$nameday_str .= ' style="color: ' . $color . '">';
} else {
$nameday_str .= '>';
}
if(isset($nameday_msg) && $nameday_msg != '' && !empty($nameday_msg)){
$csere = str_replace("%%name%%", "%s", $nameday_msg);
} else {
$csere = str_replace("%%name%%", "%s", $options['nameday_format']);
}
$msg = date_i18n($date_format).' - '.sprintf($csere, $nev_str);
if(isset($nameday_lang) && !empty($nameday_lang)){
$nameday = write_Translate($msg,$conversion = $nameday_config['default_language'].'_to_'.$lang,$bubble,'1');
} else {
$nameday = $msg.$bubble;
}
}
$nameday_str .= $nameday.'</div>';
} else {
$nameday_str = '<div class="box"';
$nameday_str .= ' style="color: red">' ;
if(isset($nameday_lang) && !empty($nameday_lang)){
$nameday = write_Translate(__('No nameday in database this language!'),$conversion = 'en_to_'.$lang,"",'1');
} else {
$nameday = __('No nameday in database this language!');
}
$nameday_str .= $nameday.'</div>';
}
return $nameday_str;
}
add_shortcode( 'nameday', 'nameday_shortcode' );
add_filter( 'widget_text', 'do_shortcode' );

class Nameday extends WP_Widget
{


function activate()
{
global $wpdb,$nameday_config;
$options = get_option('Nameday');
nameday_data_tables_exist();
$options['default_language'] = $nameday_config['default_language'];
$options['enabled_languages'] = $nameday_config['enabled_languages'];
$options['installed_languages'] = $nameday_config['installed_languages'];
$options['nameday_format'] = 'Welcome to our visitors and teammates who called %%name%%!';
$options['nameday_formatt'] = 'Next name-day will be tomorrow %%name%%!';
$options['nameday_empty'] = 'No name days!';
$options['nameday_format_original'] = 'yes';
$options['nameday_formatt_original'] = 'yes';
$options['nameday_empty_original'] = 'yes';
$options['nameday_days'] = '1';
$options['nameday_bubble'] = "yes";
$options['nameday_color1'] = "#FF01ac";
$options['nameday_bbgcolor1'] = "#FEFF01";
$options['nameday_bbgcolor2'] = "#86f886";
$options['nameday_maxname'] = "2";
$options['default_language'] = $nameday_config['default_language'];
if ( ! get_option('Nameday')){
add_option('Nameday' , $options);
} else {
update_option('Nameday' , $options);
}
}

function deactivate()
{
global $wpdb;
$table_name = NAMEDAY_TABLE_NAME;
delete_option('Nameday');
$sql="DROP TABLE IF EXISTS $table_name";
$wpdb->query($sql);
}

function Nameday()
{
$widget_ops = array('classname' => 'Nameday', 'description' => 'Nameday' );
$this->WP_Widget('Nameday', 'Nameday Widget', $widget_ops);
}

function form($instance)
{
$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
$title = $instance['title'];
?>
<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e("Label:","nameday") ?> </label>
<input id="<?php echo $this->get_field_id('title'); ?>" class="widefat" type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr($title); ?>" />
<?php }

function update($new_instance, $old_instance) {
$instance = $old_instance;
$instance['title'] = $new_instance['title'];
return $instance;
}

function widget($args, $instance)
{
global $wpdb,$nameday_config,$nyelv,$os;
//print_r($nameday_config['installed_languages']);
$options = get_option('Nameday');
//print_r($options);
if(isset($options['default_language'])){
$nyelv = $options['default_language'];
}
/*
$nyelv = $nameday_config['default_language'];
*/
$lang = $nameday_config['default_language'];
//echo $nyelv." ",$nameday_config['default_language']." ".$options['default_language'];

if(isset($options['nameday_maxname'])){
$max_name = (int)$options['nameday_maxname'];
} else {
$max_name = 2;
}
extract($args, EXTR_SKIP);
$ma = getdate();
$tomorrow = getdate(mktime (0,0,0,date("m"),date("d")+1,date("Y")));
$ho = $ma['mon'];
$nap = $ma['mday'];
$tho = $tomorrow['mon'];
$tnap = $tomorrow['mday'];
echo $before_widget;
if(isset($_SERVER["REDIRECT_URL"])){
$pre_lang = substr($_SERVER["REDIRECT_URL"],1,2);
} else {
$pre_lang = '';
}
$origin_nyelv = '';
// Use Query Mode (?lang=en)
if(isset($_GET['lang'])){
$origin_nyelv = strtolower($_GET['lang']);
$nyelv = nameday_Language(strtolower($_GET['lang']));
} elseif(strlen($pre_lang) == 2){ // Use Pre-Path Mode (Default, puts /en/ in front of URL)
$origin_nyelv = $pre_lang;
$nyelv = nameday_Language($pre_lang);
}
if($origin_nyelv != $nyelv && $origin_nyelv !=''){
$lang = $origin_nyelv;
} else {
$lang = $nyelv;
}
$nyelv = $lang;
//echo $nyelv." lang=".$lang;
$pos = strpos($nyelv, '_');
if($pos>0){
$lang = substr($nyelv, 0, $pos);
$nyelv = substr($nyelv, ($pos+1));
} else {
//
}
$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
if (!empty($title)) echo $before_title . $title . $after_title; // Start Widget
if($wpdb->get_var("SHOW TABLES LIKE '".NAMEDAY_TABLE_NAME."'") == NAMEDAY_TABLE_NAME){
$names=$wpdb->get_row("SELECT nev1,nyelv,CONCAT(nyelv,'_',orszag) as locale FROM ".NAMEDAY_TABLE_NAME." WHERE ho=$ho AND nap=$nap and orszag=UPPER('$nyelv')",ARRAY_N);
}
//echo "SELECT nev1,nyelv,CONCAT(nyelv,'_',orszag) as locale FROM ".NAMEDAY_TABLE_NAME." WHERE ho=$ho AND nap=$nap and orszag=UPPER('$nyelv')";
//$nyelvkod = $names[1].'_'.strtoupper($nyelv);
if($wpdb->num_rows>0){
$lang = $names[1];
$nyelvkod = $names[2];
} else {
$nyelvkod=$lang."_".$nyelv;
 printf( __('No nameday in database this language!') );
}
//echo "kod:".$nyelvkod." nylev=".$nyelv."def=".$nameday_config['default_language'];
$from = substr($nameday_config['default_language'],0,2);
setlocale(LC_ALL, $nyelvkod.'UTF-8');
$date_format = $nameday_config['date_format'][$nyelvkod];
$datum = date($date_format);
$datum = strftime($date_format);
?>
<div id="nev" class="nev" style="color:<?php echo $options['nameday_color1']; ?>">
<?php
$options = get_option('Nameday');
if (preg_match ("/windows/i", $os)) {
$msg = utf8_encode(sprintf(__('Current date is %s.','nameday'), $datum));
} else {
$msg=sprintf(__('Current date is %s.','nameday'), $datum);
}
//if(!in_array($lang,$nameday_config['installed_languages'])) {
if(!in_array($nyelvkod,$nameday_config['installed_languages'])) {
//$lang = $names[1];
write_Translate($msg,$conversion = $from.'_to_'.$lang);
} else {
print($msg);
}
if($wpdb->num_rows>0){
$lang = $names[1];
$nev_str = '';
$i = 0;
if(isset($names)){
$nev = explode(',',$names[0]);
if(count($nev)>$max_name){
$title = array_slice($nev, $max_name);
$title_str=implode(",",$title);
$rednev = array_slice($nev, 0, $max_name);
$nev_str = implode(",",$rednev);
$bubble = '<span title="'.$title_str.'">...</span>';
} else {
$nev_str = implode(",",$nev);
}
echo '<BR>';
$csere = str_replace("%%name%%", "%s", $options['nameday_format']);
$msg = sprintf($csere, $nev_str);
if(!in_array($nyelvkod,$nameday_config['installed_languages']) || ($options['nameday_format_original'] == 'no')) {
write_Translate($msg,$conversion = $from.'_to_'.$lang,$bubble);
} else {
printf(__('Welcome to our visitors and teammates who called %s!','nameday'), $nev_str);}
}
if($options['nameday_days']=='2' && ($wpdb->get_var("SHOW TABLES LIKE '".NAMEDAY_TABLE_NAME."'") == NAMEDAY_TABLE_NAME)){
$tnames=$wpdb->get_row("SELECT nev1, nyelv,CONCAT(nyelv,'_',orszag) as locale FROM ".NAMEDAY_TABLE_NAME." WHERE ho=$tho AND nap=$tnap and orszag=UPPER('$nyelv')",ARRAY_N);
}
if(isset($tnames)){
$tnev=explode(',',$tnames[0]);
if(count($tnev)>$max_name){
$title = array_slice($tnev, $max_name);
$title_str=implode(",",$title);
$rednev = array_slice($tnev, 0, $max_name);
$tnev_str=implode(",",$rednev);
$bubble = '<span title="'.$title_str.'">...</span>';
} else {
$tnev_str=implode(",",$tnev);
}
echo '<BR>';
$csere = str_replace("%%name%%", "%s", $options['nameday_formatt']);
$msg = sprintf($csere,  $tnev_str);
//if(!in_array($nyelv,$nameday_config['installed_languages']) || ($options['nameday_formatt_original']=='no')) {
if(!in_array($nyelvkod,$nameday_config['installed_languages']) || ($options['nameday_formatt_original']=='no')) {
write_Translate($msg,$conversion = $from.'_to_'.$lang,$bubble);
} else {
printf(__('Next name-day will be tomorrow %s.','nameday'), $tnev_str);
}
}
}
?>
</div>
<?php
echo $after_widget; } }
add_action( 'widgets_init', create_function('', 'return register_widget("Nameday");') );
$plugin_dir = basename( dirname( __FILE__ ) );
load_plugin_textdomain( 'nameday', null, $plugin_dir );
// Hook for adding admin menus
add_action('admin_menu', 'nameday_add_pages');
add_action( 'admin_notices', 'nameday_admin_notices' );
add_action( 'init', 'nameday_load_function' );

function nameday_load_function() {
 remove_action( 'admin_notices', 'nameday_admin_notices' );
}

function nameday_admin_notices() {
 echo "<div id='notice' class='updated fade'><p>Namedays is not configured yet. Please do it now.</p></div>\n";
}

function nameday_options() {
 if (!current_user_can('manage_options')) {
	 wp_die( __('You do not have sufficient permissions to access this page.') );
 }
//	 nameday_showmessage('Here is where the form would go if I actually had options.');
}

function nameday_add_pages() {
add_menu_page(__('Settings', 'nameday'), __('Nameday', 'nameday'),
	'manage_options', 'nameday', 'nameday_settings_page');
add_submenu_page('nameday', __('Languages', 'nameday'), __('Languages', 'nameday'),
	'manage_options', 'languages', 'nameday_languages_page');
}

function nameday_language_columns() {
return array(
	'default' => __('Default','nameday'),
	'flag' =>  __('Flag','nameday'),
	'name' =>  __('Name','nameday'),
	'action' => __('.mo files','nameday'),
	'datas' =>  __('dataTables','nameday')
			);
}

function nameday_isEnabled($lang) {
global $nameday_config;
return in_array($lang, $nameday_config['installed_languages']);
}

function nameday_enableLanguage($lang) {
global $nameday_config;
if(nameday_isEnabled($lang) || !isset($nameday_config['language_name'][$lang])) {
	return false;
}
$nameday_config['installed_languages'][] = $lang;
return true;
}

function nameday_installedLanguage($lang) {
global $nameday_config;
if(!isset($nameday_config['installed_languages'][$lang])) {
	return false;
}
return true;
}

function nameday_disableLanguage($lang) {
global $nameday_config;
if(nameday_isEnabled($lang)) {
	$new_enabled = array();
	for($i = 0; $i < sizeof($nameday_config['installed_languages']); $i++) {
		if($nameday_config['installed_languages'][$i] != $lang) {
			$new_enabled[] = $nameday_config['installed_languages'][$i];
		}
	}
	$nameday_config['installed_languages'] = $new_enabled;
	return true;
}
return false;
}

function nameday_print_table_headers(){
$table=nameday_language_columns();
$count=0;
foreach ($table as $name) {
	$lower_name=strtolower($name);
	if($count>1){
	echo "<th scope='col' id='status$count' class='manage-column column-status$count'  style=\"\">$name</th>";
	} else {
	echo "<th scope='col' id='$lower_name' class='manage-column column-$lower_name'  style=\"\">$name</th>";
	}
$count++;
}
}

function nameday_languages_page() {
global $nameday_config, $columns;
$error = '';
wp_enqueue_style('my-plugin-css-script', plugins_url('/nameday/css/namedayadmin.css'));
if(!isset($nameday_config['enabled_languages'])) nameday_data_tables_exist();
$options = get_option('Nameday');
if(isset($_GET['enable'])) {
// enable validate
if(!nameday_enableLanguage($_GET['enable'])) {
		$error = __('Language is already enabled or invalid!', 'nameday');
} else {
	nameday_enableLanguage($_GET['enable']);
	$options['installed_nameday'][$_GET['enable']] ='yes';
$options['installed_languages'][] = $_GET['enable'];
}
} elseif(isset($_GET['disable'])) {
// enable validate
	if($_GET['disable'] == $nameday_config['default_language'])
		$error = __('Cannot disable Default Language!', 'nameday');
	if(!nameday_isEnabled($_GET['disable']))
	if(!isset($nameday_config['language_name'][$_GET['disable']])){
		$error = __('No such language!', 'nameday');
	} else {
	$options['installed_nameday'][$_GET['disable']]='no';
//		update_option('Nameday' , $options);
	}
	if($error=='' && !nameday_disableLanguage($_GET['disable'])) {
		$error = __('Language is already disabled!', 'nameday');
	}
	}
if ( ! get_option('Nameday')){
add_option('Nameday' , $options);
} else {
update_option('Nameday' , $options);
}

if($error != '') nameday_showMessage($error,TRUE);
$clean_uri = preg_replace("/&(delete|enable|disable|markdefault)=[^&#]*/i","",$_SERVER['REQUEST_URI']);
$clean_uri = apply_filters('nameday_clean_uri', $clean_uri);
?>
<div class="wrap">
<?php
nameday_showMessage(__('If you use the plugin, make a donation!', 'nameday'),FALSE,"info");
?>
<div id="donate">
<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="JPTGSAZUSPTXW">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>
</div>
<h2><?php
nameday_options();
_e('Languages', 'nameday') ?></h2>
<?php
function nameday_checklang(){
global $nameday_config;
$options = get_option('Nameday');
if ($options['default_language'] == '' ) $options['default_language'] = $nameday_config['default_language'];
update_option('Nameday' , $options);
}

nameday_checklang();
$options = get_option('Nameday');
if (!empty($_POST) && check_admin_referer('namedaylang')) {
if (isset($_POST['nameday_default_lang_config'])) {
	if ($_POST['def_lang'] != '') {
	if($options['default_language'] != $_POST['def_lang']){
	$options['default_language'] = $_POST['def_lang'];
	$nameday_config['default_language'] = $_POST['def_lang'];
	}
	}
	update_option('Nameday' , $options);
	checknameday();
	nameday_showmessage(__('Settings saved.', 'nameday'));
}
}
nameday_options();
$puffer_language = array_flip($nameday_config['prefered_language']);
$possible_language = array_diff_key($puffer_language, $nameday_config['language_name']);
?>
<div id="col-container">
<div id="col-right">
<div class="col-wrap">
<form name="frmnamedaylang" method="post" action="">
<table class="widefat">
<thead>
<tr>
<?php nameday_print_table_headers(); ?>
</tr>
</thead>
<tfoot>
<tr>
<?php nameday_print_table_headers();?>
</tr>
</tfoot>
<tbody id="the-list" class="list:cat">
<?php foreach($nameday_config['language_name'] as $lang => $language){ if($lang != 'code') {?>
<tr>
	<td><input name="def_lang" type="radio" value="<?php echo $lang; ?>" dir="ltr" <?php if ($options['default_language'] == $lang) {
	echo ' checked="checked"';
} ?>/></td>
	<td><img src="<?php echo trailingslashit(WP_CONTENT_URL).$nameday_config['flag_location'].$nameday_config['flag'][$lang]; ?>" alt="<?php echo $language; ?>Flag" title="<?php echo $lang; ?>"></td>
	<td><?php echo $language; ?></td>
	<td><?php if(in_array($lang,$nameday_config['installed_languages'])) { ?><a class="edit" href="<?php echo $clean_uri; ?>&disable=<?php echo $lang; ?>"><?php _e('Disable', 'nameday'); ?></a><?php  } else { ?><a class="edit" href="<?php echo $clean_uri; ?>&enable=<?php echo $lang; ?>"><?php _e('Enable', 'nameday'); ?></a><?php } ?></td>
<td><?php if(in_array($lang,$nameday_config['enabled_languages'])) { ?><img src="<?php echo trailingslashit(WP_CONTENT_URL).$nameday_config['images']."enabled.gif"; ?>" alt="<?php _e('Installed!','nameday'); ?>"><?php  } else { ?><img src="<?php echo trailingslashit(WP_CONTENT_URL).$nameday_config['images']."disabled.gif"; ?>" alt="<?php _e('Missing','nameday'); ?>"><?php } ?></td>
</tr>
<?php }} ?>
</tbody>
</table>
</div>
</div><!-- /col-right -->
<div id="col-left">
<div class="col-wrap">
<?php
//print_r($nameday_config['enabled_languages']);
//echo "lang=".$lang;
echo __('.mo files','nameday') . " = " . __('These .mo, .po files are installed in language subdirectory.','nameday');
?>
<BR>
<?php
echo __('dataTables','nameday') . " = ". __('Nameday of these countries in the wp_nevnap table. Read only.','nameday');
?>
</div>
<div id="lang">
<h2><?php echo __('Default language settings', 'nameday'); ?></h2>
<?php 
/*
if(WPLANG != ''){
$pos = strpos(WPLANG, '_');
$lang = substr(WPLANG, ($pos+1));
*/
?>
<p>
<input name="def_lang" type="radio" value="<?php echo $lang; ?>" dir="ltr" <?php if ($options['default_language'] == $lang) {
	echo ' checked="checked"';
} ?>/><?php printf(__('WPLANG(%s)','nameday'), WPLANG); ?></p>
<?php //} ?>
<p>
<?php foreach($possible_language as $lang => $language){
$lang = str_replace('-','_',$lang);
$pos = strpos($lang, '_');
if($pos>0){
$temp = substr($lang, ($pos+1));
$lang = substr($lang,0,($pos+1)).strtoupper($temp);
}
?>
<input name="def_lang" type="radio" value="<?php echo $lang; ?>" dir="ltr"  <?php if ($options['default_language'] == $lang) {
	echo ' checked="checked"';
} ?>/><?php printf(__('Browser using languages(%s)','nameday'), $lang); ?></p>
<?php }
?>
<input type="hidden" id="nameday_default_lang_config" name="nameday_default_lang_config" />
<p><input name="submit" type="submit" value="<?php echo __('Save', 'nameday'); ?>" class="button-primary" /></p>
<?php wp_nonce_field('namedaylang'); ?>
</select></p>

</div>
</div><!-- /col-left -->
</form>
</div>

</div>
<?php
}

add_action('init', 'ilc_farbtastic_script');

function ilc_farbtastic_script() {
wp_enqueue_style( 'farbtastic' );
wp_enqueue_script( 'farbtastic' );
}

function checknameday(){
global $nameday_config;
$options = get_option('Nameday');
if ($options['nameday_maxname'] == '' ) $options['nameday_maxname'] = "2";
if ($options['nameday_bubble'] == '' ) $options['nameday_bubble'] = "yes";
if ($options['nameday_color1'] == '' ) $options['nameday_color1'] = "#FF01ac";
if ($options['nameday_bbgcolor1'] == '' ) $options['nameday_bbgcolor1'] = "#FEFF01";
if ($options['nameday_bbgcolor2'] == '' ) $options['nameday_bbgcolor2'] = "#86f886";
if ($options['default_language'] == '' ) $options['default_language'] = $nameday_config['default_language'];
if ($options['enabled_languages'] == '' ) $options['enabled_languages']=$nameday_config['enabled_languages'];
if ($options['installed_languages'] == '') $options['installed_languages']=$nameday_config['installed_languages'];
if ($options['nameday_empty'] == '') {
$options['nameday_empty'] = __('No name days!!', 'nameday');
$options['nameday_empty_original']='yes';
}
if ($options['nameday_hidempty'] == '') $options['nameday_hidempty']= '';
if ($options['nameday_format'] == '') {
$options['nameday_format'] = __('Welcome to our visitors and teammates who called %%name%%!','nameday');

$options['nameday_format_original']='yes';
}
if ($options['nameday_formatt'] == '') {
$options['nameday_formatt'] = __('Next name-day will be tomorrow %%name%%.','nameday');
$options['nameday_formatt_original']='yes';
}
if ($options['nameday_break'] == '') $options['nameday_break']= '1';
if ($options['nameday_days'] == '') $options['nameday_days']= '2';
update_option('Nameday' , $options);
}

function nameday_settings_page() {
 //must check that the user has the required capability
if (!current_user_can('manage_options'))
{
  wp_die( __('You do not have sufficient permissions to access this page.') );
}
remove_action( 'admin_notices', 'nameday_admin_notices' );
// Enqueue my plugins stylesheet
wp_enqueue_style('my-plugin-css-script', plugins_url('/nameday/css/namedayadmin.css'));
wp_enqueue_style( 'farbtastic' );
wp_enqueue_script( 'farbtastic' );

global $wpdb;
checknameday();
$options = get_option('Nameday');
if (!empty($_POST) && check_admin_referer('namedaycal')) {
if (isset($_POST['nameday_config'])) {
if($_POST['color_picker_color1'] != ''){
	$options['nameday_color1'] = esc_html($_POST['color_picker_color1']);
}
if($_POST['color_picker_bbgcolor1'] != ''){
	$options['nameday_bbgcolor1'] = esc_html($_POST['color_picker_bbgcolor1']);
}
if($_POST['color_picker_bbgcolor2'] != ''){
	$options['nameday_bbgcolor2'] = esc_html($_POST['color_picker_bbgcolor2']);
}
if ($_POST['nameday_bubble'] != ''){
	$options['nameday_bubble'] = esc_html($_POST['nameday_bubble']);
}
$options['nameday_days'] = $_POST['days'];
if ($_POST['empty'] != '') {
	if($options['nameday_empty'] != $_POST['empty']){
	$options['nameday_empty'] = $_POST['empty'];
	$options['nameday_empty_original']= 'no';
	}
	}
	if ($_POST['format'] != '') {
	if($options['nameday_format'] != $_POST['format']){
	$options['nameday_format'] = $_POST['format'];
	$options['nameday_format_original']= 'no';
	}
	}
	if ($_POST['formatt'] != '') {
	if($options['nameday_formatt'] != $_POST['formatt']){
	$options['nameday_formatt'] = $_POST['formatt'];
	$options['nameday_formatt_original'] = 'no';
	}
	}
	if ($_POST['nameday_config'] == '') {
	$options['nameday_config'] = 'yes';
	}
	if ($_POST['max'] == '') {
	$options['nameday_maxname'] = "2";
	} else {
	$options['nameday_maxname'] = $_POST['max'];
	}
	update_option('Nameday' , $options);
	checknameday();
	nameday_showmessage(__('Settings saved.', 'nameday'));
} elseif (isset($_POST['nameday_df'])) {
	$options['nameday_maxname'] = "2";
	$options['nameday_empty'] = '';
	$options['nameday_bubble'] = "yes";
	$options['nameday_color1'] = "#FF01ac";
	$options['nameday_bbgcolor1'] = "#FEFF01";
	$options['nameday_bbgcolor2'] = "#86f886";
	$options['nameday_format'] = __('Welcome to our visitors and teammates who called %%name%%!','nameday');
	$options['nameday_formatt'] = __('Next name-day will be tomorrow %%name%%.','nameday');
	$options['nameday_empty'] = __('No name days!','nameday');
	$options['nameday_formatt_original'] = 'yes';
	$options['nameday_format_original'] = 'yes';
	$options['nameday_empty_original'] = 'yes';
	update_option('Nameday' , $options);
	checknameday();
	nameday_showmessage(__('Settings restored.', 'nameday'));
	}
}
nameday_options();
?>
<script type="text/javascript">
	jQuery(document).ready(function($){
		$('#color_picker_color1').farbtastic('#color1');
	});
	jQuery(document).ready(function($){
		$('#color_picker_bbgcolor1').farbtastic('#bbgcolor1');
	});
	jQuery(document).ready(function($){
		$('#color_picker_bbgcolor2').farbtastic('#bbgcolor2');
	});
</script>
<div class='wrap'>
<div id="nameday_settings">
<form name = "frmnameday" method = "post" action = "">
<h2><?php echo __('Nameday', 'nameday'); ?></h2>
<p><?php echo __('Which days should be displayed?', 'nameday'); ?></p>
<p><select name="days">
<option value="1"<?php if ($options['nameday_days'] == '1') {
	echo ' selected="selected"';
} ?>><?php echo __('Only today', 'nameday'); ?></option>
<option value="2"<?php if ($options['nameday_days'] != '1') {
	echo ' selected="selected"';
} ?>><?php echo __('Today and tomorrow', 'nameday'); ?></option>
</select></p>
<p><?php echo __('Today template:', 'nameday'); ?></p>
<input name="format" style="width: 400px" type="text" value="<?php echo htmlspecialchars(stripslashes($options['nameday_format'])); ?>" dir="ltr" />
<p><?php echo __('Tomorrow template:', 'nameday'); ?></p>
<input name="formatt" style="width: 400px" type="text" value="<?php echo htmlspecialchars(stripslashes($options['nameday_formatt'])); ?>" dir="ltr" />
<p><?php echo __('Text when no records found:', 'nameday'); ?></p>
<input name="empty" style="width: 400px" type="text" value="<?php  echo htmlspecialchars(stripslashes($options['nameday_empty'])); ?>" />
<p><?php echo __('Text color:', 'nameday'); ?></p>
<input type="text" id="color1" value="<?php echo strtoupper(htmlspecialchars(stripslashes($options['nameday_color1']))); ?>" name="color_picker_color1" />
 <div id="color_picker_color1"></div>
 </div>
 <div id="nameday_bubble_settings">
 <h2><?php echo __('Bubble_settings', 'nameday'); ?></h2>
 <input name="nameday_bubble" type="radio" value="yes" dir="ltr" <?php if ($options['nameday_bubble'] == 'yes') {
	echo ' checked="checked"';
} ?>/><?php echo __('Bubble on(default)', 'nameday'); ?><br />
 <input name="nameday_bubble" type="radio" value="no" dir="ltr" <?php if ($options['nameday_bubble'] == 'no') {
	echo ' checked="checked"';
} ?>/><?php echo __('Bubble off', 'nameday'); ?>
<p><?php echo __('From Bubble:', 'nameday'); ?></p>
<input type="text" id="max" size = "2" value="<?php echo strtoupper(htmlspecialchars(stripslashes($options['nameday_maxname']))); ?>" name="max" /><span class="help">(Only integer)</span>
 <p><?php echo __('Bubble background color:', 'nameday'); ?></p>
<input type="text" id="bbgcolor1" value="<?php echo strtoupper(htmlspecialchars(stripslashes($options['nameday_bbgcolor1']))); ?>" name="color_picker_bbgcolor1" />
 <div id="color_picker_bbgcolor1"></div>
 <p><?php echo __('Bubble text color:', 'nameday'); ?></p>
<input type="text" id="bbgcolor2" value="<?php echo strtoupper(htmlspecialchars(stripslashes($options['nameday_bbgcolor2']))); ?>" name="color_picker_bbgcolor2" />
 <div id="color_picker_bbgcolor2"></div>
 </div>
<input type="hidden" id="nameday_config" name="nameday_config" />
<p><input name="submit" type="submit" value="<?php echo __('Save', 'nameday'); ?>" class="button-primary" /></p>
<?php wp_nonce_field('namedaycal'); ?>
</form>
<p><?php echo __('Template variables:', 'nameday'); ?></p>
<p><strong>%%name%%</strong> <?php nameday_showmessage(__('Display the nameday.', 'nameday')); ?></p>
<form name="frmnamedaydf" method="post" action="" style="margin-top: 50px;">
<input type="submit" name="default" value="<?php echo __('Restore Defaults', 'nameday'); ?>" class="button" onclick="javascript:return confirm('<?php echo __('Whould you like to reset settings?', 'nameday'); ?>')" />
<input type="hidden" id="nameday_df" name="nameday_df" />
<?php wp_nonce_field('namedaycal'); ?>
</form>
</div><?php
nameday_showmessage(__('If you use the plugin, make a donatione!', 'nameday'),FALSE,"info");
?>
<div id="donate">
<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="JPTGSAZUSPTXW">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>
</div>
<?php
}
?>
=== Nameday ===
Contributors: ifaur
Donate link: http://nameday.castorlandbt.eu/
Tags: nameday, name, multilingual, multi, language, widget
Requires at least: 3.4.1
Tested up to: 3.9.1
Stable tag: 1.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

The plugin (widget) displays the current (and optionally tomorrow's) name-day(s).

== Description ==

Basically WP_LANG happening in the language specified by the display name-days, but for multilingual sites
supported in Query Mode (? lang = en) and Pre-Path Mode, too.

The greeting message is changeable. In this case, and if there isn't .po file for the language of the GoogleTranslate by means of the translation. You can set the color of text in Nameday -> Nameday menu
More name-day event bubble will appear on name days. ... place your cursor on it!

Installed name-days are: Hungarian, Austrian, German, French, Swedish, Italian, English, Spanish, Polish, Czech and Slovak.

== Installation ==

1. Upload `nameday` folder to the `/wp-content/plugins/` directory

2. Activate the plugin through the 'Plugins' menu in WordPress

3. Go to Nameday menu.

4. You can add a widget to your website.

or

1. Download the plugin.

2. Extract and upload the folder to your /wp-content/plugins/ directory.

3. Activate the plugin from the administration panel.

4. Go to Nameday menu.

5. You can add a widget to your website.

== Screenshots ==

1. Front-end view (screenshot-1.png)

2. Settings template and style. (screenshot-2.png)

3. Installed namedays. (screenshot-3.png)

== Frequently Asked Questions ==

= Why are there no FAQs besides this one? =

Because you haven't asked one yet.

== Upgrade Notice ==

Installed name-days plus are: Greek


== Changelog ==

== 1.3 ==
* Tested with wordpress 3.9.1
* Bugfix missing language names

= 1.2 =
* Register shortcode [nameday] to display current name days
* By default shortcode [nameday] displays current day of the week, day and name days in Hungarian. You can use
* use shortcode in posts, pages and text widget.
* Other shortcode attributes are nameday_lang, color, nameday_msg, max_name (default is 2) and date_format (default is l, d F Y).
* You can use these attributes like this.
* Add max_name parameter to bubble parameters

`[nameday nameday_lang='en_US' color='silver' nameday_msg='Whats your name %%name%%!' date_format='d/m/Y' max_name = '3']`
* From max_name value the namedays write to title

* If you want to display name days in your theme template file, add this code.

`
<?php 
// Display name of the day
if ( function_exists( 'nameday_shortcode' ) ) {
	
	echo do_shortcode( '[nameday]' ); 
		
}
?>
`
= 1.1.1 =
* Change namedayadmin.css
* Modify sql select
* Create index to wp_nameday

= 1.1 =
* Fix nameday in functions name
* Bubble parameters
* Modify structure of wp_nameday
* Modify namedayadmin.css=======

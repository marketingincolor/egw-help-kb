<?php
/**
 * Plugin Name: Sitecore - Plugin for current site
 * Plugin URI: http://marketingincolor.com
 * Description: Site specific code changes for current site
 * Version: 1.0
 * Author: Marketing In Color
 * Author URI: http://marketingincolor.com
 * License: GPL2
 *
 * Copyright 2016 Marketing In Color (email : developer@marketingincolor.com)
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2, as
 * published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/**
 * Site-wide Security Features
 *  - Removal of the "generator" meta tag from all page content.
 */
remove_action('wp_head', 'wp_generator');

/*
NOTE: Removed TODOs and Custom Login Image since member roles
are no longer needed and the site is public facing. Also,
removed show_for_user_role function.
*/


/**
 * Custom Login image
 */
function sitecore_login_enqueue_scripts(){
	echo '<style type="text/css" media="screen">';
	echo '#login h1 a{background-image:url("'. site_url() . '';
	echo '</style>';
}
add_action( 'login_enqueue_scripts', 'sitecore_login_enqueue_scripts' );
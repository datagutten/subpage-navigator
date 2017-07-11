<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
/*
Plugin Name: Subpage navigator
Plugin URI:  https://github.com/datagutten/subpage-navigator
Description: List and navigate in sub pages
Version:     0.1
Author:      Anders Birkenes
Author URI:  https://github.com/datagutten
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: subpage-navigator
 * Domain Path: /languages
*/
require 'class-subpage-navigator.php';
$subpage_navigator= new Subpage_Navigator;

<?php
/**
 * Plugin Name: Post Sharing for Programmers
 * Version: 0.1
 * Description:
 * Author: Matt Royce
 * Author URI: http://www.mattroyce.org
 *
 * @package WordPress
 * @author	Matt Royce
**/

if (!defined('ABSPATH')) exit;

require_once 'includes/class-sharing-links.php';

if (class_exists('Sharing_Links')) {
	global $psfpSharingLinks;
	$psfpSharingLinks = new Sharing_Links();
}
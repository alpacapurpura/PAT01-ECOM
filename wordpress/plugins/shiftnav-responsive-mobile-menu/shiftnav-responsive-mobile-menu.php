<?php
/*
Plugin Name: ShiftNav - Responsive Mobile Menu
Plugin URI: http://shiftnav.io
Description: An off-canvas mobile menu for WordPress
Author: Chris Mavricos, SevenSpark
Author URI: http://sevenspark.com
License: GPLv2
Version: 1.8.2
*/

/* Copyright 2014-2025 Chris Mavricos, SevenSpark */

// Exit if accessed directly
if (!defined('ABSPATH'))
    exit;

//Version
if (!defined('SHIFTNAV_VERSION'))
    define('SHIFTNAV_VERSION', '1.8.2');

// Plugin Root File
if (!defined('SHIFTNAV_FILE'))
    define('SHIFTNAV_FILE', __FILE__);


require_once('shiftnav.class.php');


if (!function_exists('_SHIFTNAV')) {
    function _SHIFTNAV()
    {
        return ShiftNav::instance();
    }
    _SHIFTNAV();
}
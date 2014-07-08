<?php

/**
 * Local phpMemcachedAdmin version information.
 *
 * @package    local
 * @subpackage memcachedadmin
 * @copyright  2014 Michael Aherne, University of Strathclyde
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();
$plugin->version  = 2014070800;
$plugin->requires = 2010031900 ;
$plugin->maturity  = MATURITY_ALPHA;
$plugin->component = 'local_memcachedadmin'; // To check on upgrade, that module sits in correct place

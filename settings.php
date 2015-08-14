<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Local phpMemcachedAdmin settings.
 *
 * @package    local
 * @subpackage memcachedadmin
 * @copyright  2015 University of Strathclyde
 * @author     Michael Aherne
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') or die;

// This is the reason why this is a local plugin, not an admin tool:
// the cache plugins are added to the navigation after admin tools, so
// the parent category isn't there to add the link to.
if ($ADMIN->locate('cache')) {
    $url = new moodle_url('/local/memcachedadmin/index.php');
    $ADMIN->add('cache', new admin_externalpage("memcachedadmin", get_string('navlink', 'local_memcachedadmin'), $url));
}

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
 * Local phpMemcachedAdmin utility code.
 *
 * @package    local
 * @subpackage memcachedadmin
 * @copyright  2015 University of Strathclyde
 * @author     Michael Aherne
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_memcachedadmin;

class util {

    const PHP_MEMCACHED_ADMIN_DIR = 'phpMemcachedAdmin-1.2.2-r262';

    /**
     * Get the directory of the phpMemcachedAdmin code.
     */
    public static function dir() {
        global $CFG;
        return realpath($CFG->dirroot.'/local/memcachedadmin/' . self::PHP_MEMCACHED_ADMIN_DIR);
    }

    /**
     * Get the web root of the phpMemcachedAdmin code.
     */
    public static function www() {
        global $CFG;
        return $CFG->wwwroot.'/local/memcachedadmin/' . self::PHP_MEMCACHED_ADMIN_DIR;

    }

    /**
     * Return an array of memcache servers from the Moodle cache configuration.
     *
     * This is in the format expected by Library_Configuration_Loader.
     */
    public static function servers() {
        $result = array();

        // Override servers
        $stores = \cache_config::instance()->get_all_stores();
        $servers = array();
        foreach ($stores as $name => $store) {
            if (strpos($store['plugin'], 'memcache') === false) {
                continue;
            }
            $storeresult = array();
            foreach ($store['configuration']['servers'] as $server) {
                $host = $server[0];
                if (count($server) > 1) {
                    $port = $server[1];
                } else {
                    $port = 11211;
                }
                $storeresult["$host:$port"] = array('hostname' => $host, 'port' => $port);
            }
            if (!empty($storeresult)) {
                $result[$name] = $storeresult;
            }
        }

        return $result;
    }

    /**
     * Override the autoloading as we need to be able to use classes from both codebases.
     *
     * This also does the basic auth checks as it is called on every page.
     */
    public static function override_loader() {
        require_login();
        require_capability('moodle/site:config', \context_system::instance());

        // Prevent the user from trying to change the configuration.
        if (strpos($_SERVER['SCRIPT_NAME'], 'configure.php') !== false) {
            print_error('noconfigureerror', 'local_memcachedadmin');
        }

        // Add phpMemcachedAdmin's autoloading as this won't work with the Moodle one.
        spl_autoload_register(function ($class)
        {
            global $CFG;

            if (strpos($class, 'Library_') === false) {
                return;
            }

            $path = self::dir() . '/' . str_replace('_', DIRECTORY_SEPARATOR, $class) . '.php';

            if (file_exists($path)) {
                require_once $path;
            }

        }, false, true);
    }
}
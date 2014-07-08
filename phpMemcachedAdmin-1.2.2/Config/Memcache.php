<?php

defined('MOODLE_INTERNAL') or die("This can only be accessed through Moodle");

require_once($CFG->dirroot.'/local/memcachedadmin/env.php');
require_once($CFG->dirroot.'/cache/locallib.php');

global $PHPMEMCACHEDADMIN_DIR; // Needed as this is called inside a function

$stores = cache_config::instance()->get_all_stores();
$servers = array();

foreach ($stores as $name => $store) {
    if (strpos($name, 'memcache') === false) {
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
        $servers[$name] = $storeresult;
    }
}

return array (
  'stats_api' => 'Server',
  'slabs_api' => 'Server',
  'items_api' => 'Server',
  'get_api' => 'Server',
  'set_api' => 'Server',
  'delete_api' => 'Server',
  'flush_all_api' => 'Server',
  'connection_timeout' => '1',
  'max_item_dump' => '100',
  'refresh_rate' => 5,
  'memory_alert' => '80',
  'hit_rate_alert' => '90',
  'eviction_alert' => '0',
  'file_path' => $PHPMEMCACHEDADMIN_DIR.'/Temp/',
  'servers' => $servers
);
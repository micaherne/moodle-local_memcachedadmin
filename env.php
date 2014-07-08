<?php

require_once('../../config.php');

require_login(SITEID);
require_capability('moodle/site:config', context_system::instance());

$PHPMEMCACHEDADMIN_DIR = $CFG->dirroot.'/local/memcachedadmin/phpMemcachedAdmin-1.2.2';
$PHPMEMCACHEDADMIN_WWW = $CFG->wwwroot.'/local/memcachedadmin/phpMemcachedAdmin-1.2.2';

spl_autoload_register(function ($class) {
    global $PHPMEMCACHEDADMIN_DIR;
    $file = $PHPMEMCACHEDADMIN_DIR.DIRECTORY_SEPARATOR.str_replace('_', DIRECTORY_SEPARATOR, $class) . '.php';
    if (!file_exists($file)) {
        return false;
    }
    require_once $PHPMEMCACHEDADMIN_DIR.DIRECTORY_SEPARATOR.str_replace('_', DIRECTORY_SEPARATOR, $class) . '.php';
});

set_include_path(get_include_path() . PATH_SEPARATOR . $PHPMEMCACHEDADMIN_DIR);

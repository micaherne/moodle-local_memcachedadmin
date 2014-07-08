<?php

defined('MOODLE_INTERNAL') or die;

if ($ADMIN->locate('cache')) {
    $url = new moodle_url('/local/memcachedadmin/index.php');
    $ADMIN->add('cache', new admin_externalpage("memcachedadmin", get_string('navlink', 'local_memcachedadmin'), $url));
}
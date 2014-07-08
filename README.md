phpMemcachedAdmin Moodle plugin
===============================

This is a Moodle plugin which simply packages the excellent [phpMemcachedAdmin] (https://code.google.com/p/phpmemcacheadmin/) tool.

Features:

* Automatically configures the tool to point to the memcached servers or clusters set up in your Moodle cache configuration.
* Controls access to phpMemcachedAdmin - only Moodle site administrators can use it

Installation
------------

Copy the plugin to /local/memcachedadmin in your Moodle installation and go to the notifications page to install.

A new link "Memcached admin" will be added to your Site administration -> Plugins -> Caching menu.

License
-------

The plugin is available under a GPLv3 license. It contains code which is copyright 2010 Cyrille Mahieux,
licensed under the Apache License, Version 2.0.

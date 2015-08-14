The following changes have been made to the phpMemcachedAdmin library. Apart from these, the tool is a plain version of the download.

## Library\\Loader.php

The following lines added at the end of the file:

    require_once('../../../config.php');
    \local_memcachedadmin\util::override_loader();


## Library\\Configuration\\Loader.php

The following added to the end of the constructor:

    self::$_ini['servers'] = \local_memcachedadmin\util::servers();

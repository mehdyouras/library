<?php
define('DB_INI_FILE', 'configs/db.ini');
$config = @parse_ini_file(DB_INI_FILE);

define('SITE_URL', $config['SITE_URL']);
<?php
// facebook information
$appapikey = 'x';
$appsecret = 'x';
$page_id = 2;

set_include_path(dirname(__FILE__) . '/../src/' . PATH_SEPARATOR . '/home/vih/pear/php/' . PATH_SEPARATOR . get_include_path());

// implement a classloader
require_once 'Ilib/ClassLoader.php';

<?php
require_once(dirname(__FILE__) . '/SplClassLoader.php');
$ClassLoader = new SplClassLoader('PHPStrap', dirname(__FILE__) . '/vendor');
$ClassLoader->register();
?>
<?php
// Version
define('VERSION', '3.0.2.1');
define('OCTYPE', 'FREE');

// Configuration
if (is_file('config.php')) {
    //加载config.php文件，如果已经加载过，就不会再进行加载
	require_once('config.php');
}

// Install
if (!defined('DIR_APPLICATION')) {
    //跳转页面
	header('Location: ../install/index.php');
	exit;
}

//VirtualQMOD
require_once('../vqmod/vqmod.php');
VQMod::bootup();

// VQMODDED Startup
require_once(VQMod::modCheck(DIR_SYSTEM . 'startup.php'));

start('admin');

<?php
/**
 * Created by PhpStorm.
 * User: wuzijian
 * Date: 2017/5/4
 * Time: ????1:46
 */
define('ROOT', dirname(__DIR__));


//echo phpinfo();exit();
header('Content-type:text/html;charset=utf8');
require (ROOT. '/lib/func.php');
require (ROOT. '/lib/mysql.php');

$_GET = _addslashes($_GET);
$_POST = _htmlchars($_POST);
$_POST = _addslashes($_POST);

$_COOKIE = _addslashes($_COOKIE);
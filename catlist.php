<?php
/**
 * Created by PhpStorm.
 * User: dong
 * Date: 17/4/9
 * Time: обнГ5:07
 */

require('./lib/init.php');
$sql = "select * from cat";
$cat = mGetAll($sql);
//var_dump($cat);
require (ROOT.'/view/admin/catlist.html');

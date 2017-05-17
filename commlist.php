<?php
/**
 * Created by PhpStorm.
 * User: wuzijian
 * Date: 2017/5/9
 * Time: 下午5:14
 */
require ('./lib/init.php');

$sql = "select * from comment";
$comms = mGetAll($sql);
require (ROOT. '/view/admin/commlist.html');
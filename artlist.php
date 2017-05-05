<?php
/**
 * Created by PhpStorm.
 * User: wuzijian
 * Date: 2017/5/5
 * Time: 下午4:54
 */
require ('./lib/init.php');

$sql = "select art_id,title,pubtime,comm,catname from art left join cat on art.cat_id=cat.cat_id";
$arts = mGetAll($sql);
//print_r($arts);exit();

include (ROOT . '/view/admin/artlist.html');
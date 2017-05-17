<?php
/**
 * Created by PhpStorm.
 * User: dong
 * Date: 17/3/19
 * Time: 上午11:43
 */

require ('./lib/init.php');



$sql = "select catname,cat_id from cat";
$cats = mGetAll($sql);



//判断地址栏是否有cat_id
if (isset($_GET['cat_id'])){
    $where = "and art.cat_id=$_GET[cat_id]";
}else{
    $where = '';
}
$sql = "select count(*) from art where 1 ".$where;
//echo $sql;exit();
$num = mGetOne($sql);
//echo $num;exit();
$curr = isset($_GET['page'])?$_GET['page']:1;
$cnt = 2;
//var_dump($curr);exit();
$page = getPage($num,$curr,$cnt);
//print_r($page);exit();

$sql = "select title,content,comm,pubtime,catname,art_id,thumb from art inner join cat on art.cat_id=cat.cat_id where 1 ".$where . ' order by art_id desc limit ' . ($curr-1)*$cnt.','.$cnt;
$arts = mGetAll($sql);
//echo $sql;exit();
//echo json_encode($arts);exit();
require (ROOT .'/view/front/index.html');

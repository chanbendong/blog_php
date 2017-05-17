<?php
/**
 * Created by PhpStorm.
 * User: wuzijian
 * Date: 2017/5/8
 * Time: 下午5:00
 */

require ('./lib/init.php');

$art_id = $_GET['art_id'];

if (!is_numeric($art_id)){
    header('location: index.php');
}
$sql = "select * from art where art_id=$art_id";
if (!mGetRow($sql)){
    header('location: index.php');
}
$sql = "select title,content,pubtime,catname,comm,pic,thumb from art inner join cat on art.cat_id=cat.cat_id where art_id=$art_id";
$art = mGetRow($sql);
//echo json_encode($art);exit();

$sql = "select * from comment where art_id=$art_id";
$comment = mGetAll($sql);
//echo json_encode($comment);exit();
if (!empty($_POST)){
//    var_dump($_POST);exit();
    $comm['nick'] = trim($_POST['nick']);
    $comm['email'] = trim($_POST['email']);
    $comm['content'] = trim($_POST['content']);
    $comm['pubtime'] = time();
    $comm['art_id'] = $art_id;
    $comm['ip'] = sprintf('%u',ip2long(getRealIp()));
//    echo json_encode($comm);exit();
    $rs = mExec('comment',$comm);
    if ($rs){
        $sql = "update art set comm=comm+1 where art_id=$art_id";
        mQuery($sql);
       $ref = $_SERVER['HTTP_REFERER'];
        header("location: $ref");
    }
}

require (ROOT .'/view/front/art.html');
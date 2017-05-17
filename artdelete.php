<?php
/**
 * Created by PhpStorm.
 * User: wuzijian
 * Date: 2017/5/8
 * Time: 上午10:55
 */
require ('./lib/init.php');

$art_id = $_GET['art_id'];
if (!is_numeric($art_id)){
    error('文章id不合法');
}else{
    $sql = "select * from art where art_id=$art_id";
    if (!mGetRow($sql)){
        error('文章不存在');
    }
    $sql = "delete from art where art_id=$art_id";
    if (!mQuery($sql)){
        error('删除失败');
    }else{
        succ('删除成功');
    }
}
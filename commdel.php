<?php
/**
 * Created by PhpStorm.
 * User: wuzijian
 * Date: 2017/5/9
 * Time: 下午5:25
 */

require ('./lib/init.php');

$comm_id = $_GET['comment_id'];

if (!is_numeric($comm_id)) {
    error('文章id不合法');
}
$sql = "select * from comment where comment_id=$comm_id";
if (!empty(mQuery($sql))){
    $comm = mGetRow($sql);
    $sql = "delete from comment where comment_id=$comm[comment_id]";
    if (mQuery($sql)){
        $sql = "update art set comm=comm-1 where art_id=$comm[art_id]";
        mQuery($sql);
        header('location: commlist.php');
    }
}
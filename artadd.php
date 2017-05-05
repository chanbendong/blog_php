<?php
/**
 * Created by PhpStorm.
 * User: wuzijian
 * Date: 2017/5/5
 * Time: 下午4:17
 */
require ('./lib/init.php');

$sql = 'select * from cat';
$cats = mGetAll($sql);

if (empty($_POST)){
    require (ROOT.'/view/admin/artadd.html');
}else{
    $art['title'] = trim($_POST['title']);
    if (empty($art['title'])){
        error('标题不能为空');
    }

    $art['cat_id'] = $_POST['cat_id'];
    if (!is_numeric($art['cat_id'])){
        error('栏目不合法');
    }
    $art['content']= trim($_POST['content']);
    if (empty($art['content'])){
        error('内容不能为空');
    }

    //插入发布时间
    $art['pubtime'] = time();
    if (mExec('art', $art)){
        error('文章发布成功');
    }else{
        succ('文章发布失败');
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: wuzijian
 * Date: 2017/5/8
 * Time: 上午11:01
 */

require ('./lib/init.php');

$art_id = $_GET['art_id'];
if (!is_numeric($art_id)){
    error('文章id不合法');
}else {
    $sql = "select * from art where art_id=$art_id";
    if (!mGetRow($sql)) {
        error('文章不存在');
    }

    if (empty($_POST)) {
        $sql = "select title,content,arttag,cat_id from art where art_id=$art_id";
        $arts = mGetRow($sql);
        $sql = "select * from cat";
        $cats = mGetAll($sql);
        include(ROOT . '/view/admin/artedit.html');
    } else {
        $art['title'] = trim($_POST['title']);
        if (empty($art['title'])) {
            error('标题不能为空');
        }

        $art['cat_id'] = $_POST['cat_id'];
        if (!is_numeric($art['cat_id'])) {
            error('栏目不合法');
        }
        $art['content'] = trim($_POST['content']);
        if (empty($art['content'])) {
            error('内容不能为空');
        }
        $art['lastup'] = time();
        $art['arttag'] = trim($_POST['tags']);
        if (!mExec('art', $art, 'update', "art_id=$art_id")) {
            error('修改失败');
        } else {
            $art_id = mGetId();
            $sql = "delete from tag where art_id=$art_id";
            mQuery($sql);
            $sql = "insert into tag (art_id,tag) values ";
            $tags = explode(',', $art['arttag']);
            foreach ($tags as $t) {
                $sql .= '(' . $art_id . ',' . "'$t'" . ') ,';
            }
            $sql = rtrim($sql, ',');
            if (mQuery($sql)) {
                succ('文章修改成功');
            }

        }
    }
}



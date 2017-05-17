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
        if (!empty($_FILES['pic']['name']) && $_FILES['pic']['error'] == 0){
            $des = createDir().'/'.ranstr().getExt($_FILES['pic']['name']);
            $des = str_replace(ROOT,'',$des);
            if (move_uploaded_file($_FILES['pic']['tmp_name'],ROOT.$des)){
                $art['pic'] = $des;
                $art['thumb'] = makeThumb($des);
            }

        }

        //插入发布时间
        $art['pubtime'] = time();
        $art['arttag'] = trim($_POST['tag']);
        if (mExec('art', $art)){
            $art['arttag'] = trim($_POST['tag']);
            if ($art['arttag'] == ''){
                $sql = "update cat set num=num+1 where cat_id=$art[cat_id]";
                mQuery($sql);
                error('文章发布成功');
            }else{
                //获取上次insert 操作产生的主键id
                $art_id = mGetId();
                $sql = "insert into tag (art_id,tag) values ";
                $tags = explode(',',$art['arttag']);
                foreach ($tags as $t){
                    $sql .= '(' . $art_id . ',' . "'$t'" . ') ,';
                }
                $sql = rtrim($sql,',');
                if (mQuery($sql)){
                    $sql = "update cat set num=num+1 where cat_id=$art[cat_id]";
                    mQuery($sql);
                    succ('文章添加成功');
                }else{
                    //tag 添加失败 删除原文章
                    $sql = "update cat set num=num+1 where cat_id=$art[cat_id]";
                    mQuery($sql);
                    $sql = "delete from art where art_id=$art_id";
                    if (mQuery($sql)){
                        error('文章添加失败');
                    }
                }
            }

        }else{
            succ('文章发布失败');
        }
    }
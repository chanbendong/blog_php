<?php
/**
 * Created by PhpStorm.
 * User: dong
 * Date: 17/4/9
 * Time: 下午5:27
 */
require('./lib/init.php');
if (empty($_GET['cat_id'])){
    echo '找不到该栏目';
}else{
    $cat_id = $_GET['cat_id'];
    if(!is_numeric($cat_id)){
        echo "栏目不合法";
        exit();
    }



    $sql = "select * from cat where cat_id=$cat_id";
    if(!empty(mGetRow($sql))){
        $sql = "select * from art where cat_id=$cat_id";
        if (!empty(mGetRow($sql))){
            echo '栏目下有文章';
            exit();
        }else{

            if (!mDelete('cat',"cat_id=$cat_id")){
                echo '栏目删除失败';
            }else{
                echo '删除成功';

            }
        }
    }else{
        echo '栏目不存在';
        exit();
    }
}

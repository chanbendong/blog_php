<?php
/**
 * Created by PhpStorm.
 * User: dong
 * Date: 17/4/9
 * Time: 下午5:26
 */
require('./lib/init.php');

if (empty($_GET['cat_id'])){
    echo '找不到该项目';
}else{
    $cat_id = $_GET['cat_id'];
    if(!is_numeric($cat_id)){
        echo "栏目不合法";
        exit();
    }
    if (empty($_POST)){
        $sql = "select * from cat where cat_id=$cat_id";
        $cat = mGetRow($sql);
        if (!empty($cat)){
            require (ROOT.'/view/admin/catedit.html');
        }else{
            echo '该栏目不存在';
        }
    }else{
        $cat['catname'] = $_POST['catname'];
        if (!mExec('cat',$cat,'update',"cat_id=$cat_id")){
            echo '栏目修改失败';
        }else{
            echo '栏目修改成功';
        }

    }
}

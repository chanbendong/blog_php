<?php
/**
 * Created by PhpStorm.
 * User: dong
 * Date: 17/4/9
 * Time: 下午5:26
 */

include ('mysql.php');




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
        $rs = mysqli_query($conn, $sql);
        $cat = mysqli_fetch_assoc($rs);
        if (!empty($cat)){
            require ('./view/admin/catedit.html');
        }else{
            echo '该栏目不存在';
        }
    }else{
        $post_catname = $_POST['catname'];
        $sql = "update cat set catname='$post_catname' where cat_id=$cat_id";
        if (!mysqli_query($conn, $sql)){
            echo '栏目修改失败';
        }else{
            echo '栏目修改成功';
        }

    }
}

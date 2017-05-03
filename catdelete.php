<?php
/**
 * Created by PhpStorm.
 * User: dong
 * Date: 17/4/9
 * Time: 下午5:27
 */
include ('mysql.php');
if (empty($_GET['cat_id'])){
    echo '找不到该栏目';
}else{
    $cat_id = $_GET['cat_id'];
    if(!is_numeric($cat_id)){
        echo "栏目不合法";
        exit();
    }



    $sql = "select * from cat where cat_id=$cat_id";
    $rs = mysqli_query($conn, $sql);
    $s = mysqli_fetch_assoc($rs);
    if(!empty($s)){
        $sql = "select * from art where cat_id=$cat_id";
        $rs = mysqli_query($conn, $sql);
        $s = mysqli_fetch_assoc($rs);
        if (!empty($s)){
            echo '栏目下有文章';
            exit();
        }else{
            $sql = "delete from cat where cat_id=$cat_id";
            if (!mysqli_query($conn,$sql)){
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

<?php
/**
 * Created by PhpStorm.
 * User: dong
 * Date: 17/4/9
 * Time: 下午3:40
 */

include ('mysql.php');
if (empty($_POST)){
    include ('./view/admin/catadd.html');
}else{

    $cat['catname'] = trim($_POST['catname']);
    if (empty($cat['catname'])){
        echo '栏目不能为空';
        exit();
    }
    $sql = "select * from cat where catname = '$cat[catname]'";
    $rs = mysqli_query($conn, $sql);
//    $s = mysqli_fetch_row($rs);
    $s = mysqli_fetch_assoc($rs);
    if (!empty($s)){
//        print_r($catname);
        echo '栏目已经存在';
        exit();
    }else{
        $sql = "insert into cat (catname) values ('$cat[catname]')";
        if (mysqli_query($conn, $sql)){
            echo '栏目插入成功';
        }
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: dong
 * Date: 17/4/9
 * Time: ����5:26
 */

include ('mysql.php');




if (empty($_GET['cat_id'])){
    echo '�Ҳ�������Ŀ';
}else{
    $cat_id = $_GET['cat_id'];
    if(!is_numeric($cat_id)){
        echo "��Ŀ���Ϸ�";
        exit();
    }
    if (empty($_POST)){
        $sql = "select * from cat where cat_id=$cat_id";
        $rs = mysqli_query($conn, $sql);
        $cat = mysqli_fetch_assoc($rs);
        if (!empty($cat)){
            require ('./view/admin/catedit.html');
        }else{
            echo '����Ŀ������';
        }
    }else{
        $post_catname = $_POST['catname'];
        $sql = "update cat set catname='$post_catname' where cat_id=$cat_id";
        if (!mysqli_query($conn, $sql)){
            echo '��Ŀ�޸�ʧ��';
        }else{
            echo '��Ŀ�޸ĳɹ�';
        }

    }
}

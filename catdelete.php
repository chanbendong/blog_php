<?php
/**
 * Created by PhpStorm.
 * User: dong
 * Date: 17/4/9
 * Time: ����5:27
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



    $sql = "select * from cat where cat_id=$cat_id";
    $rs = mysqli_query($conn, $sql);
    $s = mysqli_fetch_assoc($rs);
    if(!empty($s)){
        $sql = "select * from art where cat_id=$cat_id";
        $rs = mysqli_query($conn, $sql);
        $s = mysqli_fetch_assoc($rs);
        if (!empty($s)){
            echo '��Ŀ��������';
            exit();
        }else{
            $sql = "delete from cat where cat_id=$cat_id";
            if (!mysqli_query($conn,$sql)){
                echo '��Ŀɾ��ʧ��';
            }else{
                echo 'ɾ���ɹ�';

            }
        }
    }else{
        echo '��Ŀ������';
        exit();
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: dong
 * Date: 17/4/9
 * Time: ����5:27
 */
require('./lib/init.php');
if (empty($_GET['cat_id'])){
    echo '�Ҳ�������Ŀ';
}else{
    $cat_id = $_GET['cat_id'];
    if(!is_numeric($cat_id)){
        echo "��Ŀ���Ϸ�";
        exit();
    }



    $sql = "select * from cat where cat_id=$cat_id";
    if(!empty(mGetRow($sql))){
        $sql = "select * from art where cat_id=$cat_id";
        if (!empty(mGetRow($sql))){
            echo '��Ŀ��������';
            exit();
        }else{

            if (!mDelete('cat',"cat_id=$cat_id")){
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

<?php
/**
 * Created by PhpStorm.
 * User: dong
 * Date: 17/4/9
 * Time: ����5:26
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
    if (empty($_POST)){
        $sql = "select * from cat where cat_id=$cat_id";
        $cat = mGetRow($sql);
        if (!empty($cat)){
            require (ROOT.'/view/admin/catedit.html');
        }else{
            echo '����Ŀ������';
        }
    }else{
        $cat['catname'] = $_POST['catname'];
        if (!mExec('cat',$cat,'update',"cat_id=$cat_id")){
            echo '��Ŀ�޸�ʧ��';
        }else{
            echo '��Ŀ�޸ĳɹ�';
        }

    }
}

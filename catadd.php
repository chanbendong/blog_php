<?php
/**
 * Created by PhpStorm.
 * User: dong
 * Date: 17/4/9
 * Time: 下午3:40
 */

require('./lib/init.php');
if (empty($_POST)){
    include (ROOT .'/view/admin/catadd.html');
}else{

    $cat['catname'] = trim($_POST['catname']);

    if (empty($cat['catname'])){
        echo '栏目不能为空';
        exit();
    }
    $sql = "select * from cat where catname = '$cat[catname]'";
    if (!empty(mGetRow($sql))){
        error('栏目已经存在');
        exit();
    }else{
        if (mExec('cat', $cat)){
            succ('成功');
        }else{
            error('插入失败');
        }
    }
}
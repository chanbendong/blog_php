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
    echo '找到了';
}
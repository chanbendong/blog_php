<?php
/**
 * Created by PhpStorm.
 * User: wuzijian
 * Date: 2017/5/9
 * Time: 下午5:43
 */

//echo '<pre>';
//print_r($_FILES);
//echo '<pre>';


$path = './upload/'.date('Y/m');
if (!is_dir($path)){
    mkdir($path, 0777, true);
}
$rand = rand(10000,99999);
$ext = strchr($_FILES['pic']['name'],'.');
$des = $path.'/'.$rand.$ext;

echo move_uploaded_file($_FILES['pic']['tmp_name'],$des)?'ok':'fail';;
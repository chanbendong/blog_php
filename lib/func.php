<?php
/**
 * Created by PhpStorm.
 * User: wuzijian
 * Date: 2017/5/4
 * Time: 下午12:00
 */

function succ($res="成功"){
    $result = 'succ';
    require (ROOT.'/view/admin/info.html') ;
    exit();
}

function error($res){
    $result = 'fail';
    require (ROOT . '/view/admin/info.html');
    exit();
}
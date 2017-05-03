<?php
/**
 * Created by PhpStorm.
 * User: dong
 * Date: 17/4/9
 * Time: 下午5:07
 */



/*
 *链接数据库
 *
 */
function mConn(){
    static  $conn = null;
    if ($conn === null){
        $conn = mysqli_connect('localhost','root','');
        mysqli_query($conn,'use blog');
        mysqli_query($conn,'set names utf8');
    }
    return $conn;
}

/*
 * 查询的函数
 * return mixed resource/bool
 *
 */
function mQuery($sql){
    return mysqli_query(mConn(), $sql);
}

/*
 * 查询返回二维数据
 * params str $sql
 *  */
function mGetAll($sql){
    $rs = mQuery($sql);
    if (!$rs){
        return false;
    }

    $data = array();
    while ($row = mysqli_fetch_assoc($rs)){
        $data[] = $row;
    }
    return $data;
}

/*
 *select 取出一行数据
 *  return 查询成功 返回一个一维数组
 */
function mGetRow($sql){
    $rs = mQuery($sql);
    if (!$rs){
        return false;
    }
    return mysqli_fetch_assoc($rs);

}

function mGetOne($sql){
    $rs = mQuery($sql);
    if (!$rs){
        return false;
    }
    return mysqli_fetch_row($rs)[0];
}

/*
 * 插入函数
 */
function mExec($table,$data, $act = 'insert'){
    if ($act == 'insert'){
        $sql = "insert into $table (";
        $sql .= implode(',', array_keys($data)).") values ('";
        $sql .= implode("','", array_values($data))."')";
        return $sql;

    }

}


<?php
/**
 * Created by PhpStorm.
 * User: dong
 * Date: 17/4/9
 * Time: ����5:07
 */



/*
 *�������ݿ�
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
 * ��ѯ�ĺ���
 * return mixed resource/bool
 *
 */
function mQuery($sql){
    return mysqli_query(mConn(), $sql);
}

/*
 * ��ѯ���ض�ά����
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
 *select ȡ��һ������
 *  return ��ѯ�ɹ� ����һ��һά����
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
 * ���뺯��
 */
function mExec($table,$data, $act = 'insert'){
    if ($act == 'insert'){
        $sql = "insert into $table (";
        $sql .= implode(',', array_keys($data)).") values ('";
        $sql .= implode("','", array_values($data))."')";
        return $sql;

    }

}


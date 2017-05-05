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
        $cfg = require(ROOT.'/lib/config.php');
        $conn = mysqli_connect($cfg['host'],$cfg['user'],$cfg['pwd']);
        mysqli_query($conn,'use ' .$cfg['db']);
        mysqli_query($conn,'set names ' . $cfg['charset']);
    }
    return $conn;
}

/*
 * ��ѯ�ĺ���
 * return mixed resource/bool
 *
 */
function mQuery($sql){
    $rs =  mysqli_query(mConn(), $sql);
    if ($rs){
        mLog($sql);
    }else{
        mLog($sql . "\n" .mysqli_error(mConn()));
    }
    return $rs;
}

/*
 * log��־��¼����
 */
function mLog($str){
    $filename = ROOT . '/log/' . date('Ymd').'.text';
    $log = "--------------------------------------\n".date('Y/m/d H:i:s'). "\n" .$str ."\n" ."--------------------------------------\n\n";
    return file_put_contents($filename, $log,FILE_APPEND);
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
function mExec($table,$data, $act = 'insert' , $where = 0){
    if ($act == 'insert'){
        $sql = "insert into $table (";
        $sql .= implode(',', array_keys($data)).") values ('";
        $sql .= implode("','", array_values($data))."')";
        return mQuery($sql);
    }elseif ($act == 'update'){
        $sql = "update $table set ";
        foreach ($data as $k=>$v){
            $sql .= $k . "='" . $v . "',";
        }
        $sql = rtrim($sql, ','). " where " . $where;
//        echo $sql;
        return mQuery($sql);
    }
}


//$data = array('title'=>'����Ŀ���','content'=>'����������','pubtime'=>123456,'author'=>'bait');
//echo  mExec('art', $data, 'update','cat_id=1');

/*
 * ȡ����һ��insert ����ȡ�õ�id
 */
function mGetId(){
    return mysqli_insert_id(mConn());
}

/*
 * ɾ������
 */

function mDelete($table, $where=0){
    $sql = "delete from $table where $where";
    return mQuery($sql);
}
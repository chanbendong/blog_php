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

/*
 * 获取来访者的真实IP
 */

function getRealIp(){
    static  $realIp = null;
    if ($realIp !== null){
        return $realIp;
    }

    if (getenv('REMOTE_ADDR')){
        $realIp = getenv('REMOTE_ADDR');
    }elseif (getenv('HTTP_CLIENT_IP')){
        $realIp = getenv('HTTP_CLIENT_IP');
    }elseif (getenv('HTTP_X_FORWARD_FOR')){
        $realIp = getenv('HTTP_X_FORWARD_FOR');
    }
//    echo $realIp;exit();
    return $realIp;
}

/*
 * 生成分页代码
 * @param int $num 文章总数
 * @param int $curr 当前显示的页码数
 * @param int $cnt 每页显示的条数
 */

function getPage($num,$curr,$cnt){
    if ($num == 0){
        return array();
    }
    $max = ceil($num/$cnt);
    //最左侧页码
    $left = max(1, $curr-2);
    //最右侧页码
    $right = min($left+4,$max);

    $left = max(1, $right-4);

    for($i=$left; $i<=$right;$i++){
        $_GET['page'] = $i;
        $page[$i] = http_build_query($_GET);
    }
//    var_dump($page);
//    exit();
    return $page;

}

/*
 * 按日期创建存储目录
 */

function createDir(){
    $path = '/upload/'.date('Y/m/d');
    $abs = ROOT.$path;

    if (is_dir($abs) || mkdir($abs, 0777, true)){
        return $abs;
    }else{
        return false;
    }
}

/*
 * 生成随机字符串
 */
function ranstr($length=6){
    $str = str_shuffle('QWERTYUIOPASDFGHJKLZXCVBNMqwertyuiopasdfghjklzxcvbnm12345677890');
    $str = substr($str, 0, $length);
    return $str;
}

/*
 * 获取文件后缀
 */
function getExt($name){
    return strchr($name, '.');
}

/*
 * 生成缩略图
 * @param str $oimg 原图地址
 * @param int $sw 生成图的宽
 * @param int $sh 生成图的高
 * @return str 生成图的路径
 */

function makeThumb($oimg, $sw=200, $sh=200){
    $simg = dirname($oimg).'/'.ranstr().'.png';

    $opath = ROOT.$oimg;
    $spath = ROOT.$simg;

    $spic = imagecreatetruecolor($sw, $sh);
    $white = imagecolorallocate($spic,255, 255, 255);
    imagefill($spic,0, 0, $white);
    list($bw, $bh, $btype) = getimagesize($opath);

    $map = array(
        1=>'imagecreatefromgif',
        2=>'imagecreatefromjpeg',
        3=>'imagecreatefrompng',
        15=>'imagecreatefromwbmp'
    );
    if (!isset($map[$btype])){
        return false;
    }

    $opic = $map[$btype]($opath);


    $rate = min($sw/$bw, $sh/$bh);
    $zw = $bw *$rate;
    $zh = $bh *$rate;
//    echo  $zw,'<br>',$rate,'<br>',$zh;exit();
    imagecopyresampled($spic, $opic, ($sw-$zw)/2, ($sh-$zh)/2, 0, 0, $zw, $zh, $bw, $bh);
    imagepng($spic, $spath);
    imagedestroy($spic);
    imagedestroy($opic);
    return $simg;

}

/*
 * 检测用户是否登录
 */

function acc(){
    return isset($_COOKIE['name']);
}

/*
 * 用户输入转成实体
 */
function _htmlchars($arr){
    foreach ($arr as $k=>$v){
        if (is_string($v)){
            $arr[$k] = htmlspecialchars($v);
        }else if (is_array($v)){
            $arr[$k] = _htmlchars($v);
        }
    }
    return $arr;
}

/*
 * 使用反斜线 转义字符串
 */

function _addslashes($arr){
    foreach ($arr as $k=>$v){
        if (is_string($v)){
            $arr[$k] = addslashes($v);
        }else if (is_array($v)){
            $arr[$k] = _addslashes($v);
        }
    }
    return $arr;
}
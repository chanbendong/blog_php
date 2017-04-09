<?php
/**
 * Created by PhpStorm.
 * User: dong
 * Date: 17/4/9
 * Time: 下午5:07
 */

include ('mysql.php');
$sql = "select * from cat";
$rs = mysqli_query($conn,$sql);
$cat = array();
while ($s = mysqli_fetch_assoc($rs)){
    $cat[] = $s;
}
require ('./view/admin/catlist.html');

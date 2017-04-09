<?php
/**
 * Created by PhpStorm.
 * User: dong
 * Date: 17/4/9
 * Time: 下午5:07
 */

$conn = mysqli_connect('localhost','root','');
mysqli_query($conn,'use blog');
mysqli_query($conn,'set names utf8');
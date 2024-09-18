<?php
$connect=mysqli_connect("localhost", "root","", "qlvexemphim");
if(!$connect){
    die('Không thể kết nối đến cơ sở dữ liệu: ' . mysqli_connect_error());
}
mysqli_query($connect, "SET NAMES 'utf8");
?>
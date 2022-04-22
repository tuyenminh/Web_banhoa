<?php
// b1: kết nối
$conn=mysqli_connect("localhost", "root", "", "web_hoa");
// b2: khai báo ngôn ngữ
mysqli_query($conn, "SET NAMES 'utf8'");
?>
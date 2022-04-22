<?php
session_start();
include_once('modules/connect/connect.php');
if(isset($_SESSION['mail'])&& isset($_SESSION['pass'])){
    $dm_id=$_GET['dm_id'];
    $sql="DELETE FROM damhmucs WHERE dm_id= $dm_id";
    mysqli_query($conn, $sql);
    header('location: index.php?page_layout=category');
}
?>
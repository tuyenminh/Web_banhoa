<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>SHOP BÁN HOA TƯƠI 24/7</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <link rel="stylesheet" type="text/css" href="../css/style.css" >
        <script src="../resources/ckeditor/ckeditor.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
        rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>   
    </head>
    <nav>
      <div class="container-fluid">
        <div class="row text-center">
          <div class= "col-3 ">
            <a href="#" title="Hoa Online 247">
              <img class="top-logo" src="../images/hoa-online-247.png" alt="Hoa Online 247">
            </a>
          </div>
          <div class="col text-white">
            <h1 style = "margin-top: 50px; font-size: 50px; color: white; text-shadow: 5px 2px 4px grey, 10px -3px 4px green;">SHOP HOA TƯƠI ONLINE 24/7</h1>
          </div>
          <div class= "col-3">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
              <button class="btn btn-outline-success fw-bolder" style = "margin-top: 50px;" type="button">  <a href="./edit.php">Đổi mật khẩu</a><br/></button>
              <button class="btn btn-outline-success fw-bolder" style = "margin-top: 50px;" type="button"><a href="./logout.php">Đăng xuất</a></button>
            </div>
          </div>
      </div>
    </nav>
    <body>
    <?php
        session_start();
        include '../connect_db.php';
        include '../function.php';
        if (!empty($_SESSION['current_user'])) { //Kiểm tra xem đã đăng nhập chưa?
    ?>
        <div class="container-fluid">
          <div class= "row" style = "height: 60px; padding: 10px; font-size: 20px;">
          <ul class="nav justify-content-end">
            <li class="nav-item">
            <i class="fa-solid fa-house-chimney"></i>
              <a class="nav-link active text-white fw-bolder" aria-current="page" href="../index.php" >TRANG CHỦ </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white fw-bolder" href="#">TIN TỨC</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white fw-bolder " href="product_listing.php">SẢN PHẨM</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white fw-bolder" href="#">ĐƠN HÀNG</a>
            </li>
          </ul>
            
          </div>
        </div>
            <?php } ?>
      </body>
</html>
<?php
include 'header.php';
if (!empty($_SESSION['current_user'])) {
    $item_per_page = (!empty($_GET['per_page'])) ? $_GET['per_page'] :6;
    $current_page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
    $offset = ($current_page - 1) * $item_per_page;
    $totalRecords = mysqli_query($con, "SELECT * FROM `product`");
    $totalRecords = $totalRecords->num_rows;
    $totalPages = ceil($totalRecords / $item_per_page);
    $products = mysqli_query($con, "SELECT * FROM `product` ORDER BY `id` DESC LIMIT " . $item_per_page . " OFFSET " . $offset);
    mysqli_close($con);
    ?>
    

        <head>
            <title>Bài 12: Hướng dẫn tạo trang quản trị (admin): quản lý sản phẩm - Phần 1</title>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            
            <link rel="stylesheet" type="text/css" href="../css/list.css" >
            <script src="../resources/ckeditor/ckeditor.js"></script>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" 
            crossorigin="anonymous">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>   
        </head>
        <div class="container text-center">
            <div class= "row" style = "margin-top: 20px; margin-bottom: 20px;">
                <h1 class ="fw-bolder">DANH SÁCH SẢN PHẨM</h1>
            </div>
            <div class="row">
             <a href="./product_editing.php" ><button type="button" class="btn btn-primary btn-lg fw-bold btn-success" 
                style="margin-bottom: 10px; margin-left: 1090px;">THÊM SẢN PHẨM</button> 
            </a>   
            </div>
            <div class="row border border-dark border-2">
                <div class="col p-2 bg-light border">
                    <div class="product-prop-product-id fw-bold">STT</div>
                </div>
                <div class="col p-2 bg-light border">
                    <div class="product-prop-product-masp fw-bold">MÃ SẢN PHẨM</div>
                </div>
                <div class="col p-2 bg-light border">
                    <div class="product-prop product-name fw-bold">TÊN SẢN PHẨM</div>
                </div>
                <div class="col p-2 bg-light border">
                    <div class="product-prop-product-img fw-bold">ẢNH</div>
                </div>
                <div class="col p-2 bg-light border">
                    <div class="product-prop-product-price fw-bold">GIÁ (nghìn đồng)</div>
                </div>
                <div class="col p-2 bg-light border">
                    <div class="product-prop-product-content fw-bold">MÔ TẢ</div>
                </div>
                <div class="col p-2 bg-light border fw-bold">HÀNH ĐỘNG  
                    <div class="product-prop product-button">
                    </div>
                    <div class="product-prop product-button">
                    </div>
                    <!-- <div class="product-prop product-button">
                    </div>                 -->
                </div>
                <div class="col  p-2 bg-light border fw-bold">
                    <div class="product-prop product-time fw-bold">NGÀY TẠO</div>
                </div>
                <div class="col  p-2 bg-light border fw-bold">
                    <div class="product-prop product-time fw-bold">NGÀY CẬP NHẬT</div>
                </div>
                <!-- <div class="col">
                    <div class="clear-both"></div>
                </div> -->
        </div>
        
            <!-- <ul>
                <li class="product-item-heading">
                    <div class="product-prop product-img">Ảnh</div>
                    <div class="product-prop product-name">Tên sản phẩm</div>
                    <div class="product-prop product-button">
                        Xóa
                    </div>
                    <div class="product-prop product-button">
                        Sửa
                    </div>
                    <div class="product-prop product-button">
                        Copy
                    </div>
                    <div class="product-prop product-time">Ngày tạo</div>
                    <div class="product-prop product-time">Ngày cập nhật</div>
                    <div class="clear-both"></div>
                </li> -->
                <?php
                while ($row = mysqli_fetch_array($products)) {
                    ?>
                <div class="row align-items-center border border-dark border-2" style = "font-size: 20px;">
                    <div class="col">
                        <div class="product-prop-product-id"><?= $row['id'] ?></div>
                    </div>
                    <div class="col">
                        <div class="product-prop-product-masp"><?= $row['masp'] ?></div>
                    </div>
                    <div class="col">
                        <div class="product-prop product-name"><?= $row['name'] ?></div>
                    </div>
                    <div class="col">
                        <div class="product-prop-product-img" ><img style="width: 150px; height: 150px; padding-top: 10px; padding-bottom:10px;"
                        src="../<?= $row['image'] ?>" alt="<?= $row['name'] ?>" title="<?= $row['name'] ?>" /></div>
                    </div>  
                    <div class="col">
                        <div class="product-prop product-price"><?= $row['price'] ?></div>
                    </div>
                    <div class="col">
                        <div class="product-prop product-content" 
                        style = "
                                overflow: hidden;
                                -webkit-line-clamp: 3;
                                display: -webkit-box;
                                -webkit-box-orient: vertical;">
                        <?= $row['content'] ?></div>
                    </div>
                    <div class="col">
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                            <button type="button" class="product-prop product-button btn btn-danger">
                                <a class="text-white" style="text-decoration: none" href="./product_delete.php?id=<?= $row['id'] ?>">XÓA</a>
                            </button>
                            <button type="button" class="product-prop product-button btn btn-success">
                                <a class="text-white" style="text-decoration: none" href="./product_editing.php?id=<?= $row['id'] ?>">EDIT</a>
                            </button>
                            <!-- <button type="button" class="product-prop product-button btn btn-success">
                                <a href="./product_editing.php?id=<?= $row['id'] ?>&task=copy">Copy</a>
                            </button> -->
                        </div>
                    </div>
                    <div class="col">
                        <div class="product-prop product-time"><?= date('Y/m/d H:i:s', $row['created_time']) ?></div>
                    </div>
                    <div class="col">
                        <div class="product-prop product-time"><?= date('d/m/Y H:i', $row['last_updated']) ?></div>
                    </div>
                    <!-- <div class="col">
                        <div class="clear-both"></div>
                    </div> -->
                </div>
                    <!-- <li>
                        <div class="product-prop product-img"><img src="../<?= $row['image'] ?>" alt="<?= $row['name'] ?>" title="<?= $row['name'] ?>" /></div>
                        <div class="product-prop product-name"><?= $row['name'] ?></div>
                        <div class="product-prop product-button">
                            <a href="./product_delete.php?id=<?= $row['id'] ?>">Xóa</a>
                        </div>
                        <div class="product-prop product-button">
                            <a href="./product_editing.php?id=<?= $row['id'] ?>">Sửa</a>
                        </div>
                        <div class="product-prop product-button">
                            <a href="./product_editing.php?id=<?= $row['id'] ?>&task=copy">Copy</a>
                        </div>
                        <div class="product-prop product-time"><?= date('d-m-Y H:i', $row['created_time']) ?></div>
                        <div class="product-prop product-time"><?= date('d-m-Y H:i', $row['last_updated']) ?></div>
                        <div class="clear-both"></div>
                    </li> -->
                <?php } ?>
            <!-- </ul> -->
            <?php
            include './pagination.php';
            ?>
            <div class="clear-both"></div>
        </div>
    <?php
}
include './footer.php';
?>
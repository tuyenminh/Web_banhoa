<?php
include 'header.php';
if (!empty($_SESSION['current_user'])) {
    ?>
    
        <divb class="container">
            <div class= "row" style = "margin-top: 20px; margin-bottom: 20px;">
                    <h1 class ="fw-bolder">THÊM SẢN PHẨM</h1>
            </div>
            <?php
            if (isset($_GET['action']) && $_GET['action'] == 'add') {
                if (isset($_POST['masp']) && !empty($_POST['masp']) && isset($_POST['name']) && !empty($_POST['name']) 
                && isset($_POST['price']) && !empty($_POST['price']) && isset($_POST['content']) && !empty($_POST['content'])) {
                    $galleryImages = array();
                    if (empty($_POST['masp'])) {
                        $error = "Bạn phải nhập mã sản phẩm";
                    } elseif (empty($_POST['name'])) {
                        $error = "Bạn phải nhập tên sản phẩm";
                    } elseif (empty($_POST['price'])) {
                        $error = "Bạn phải nhập giá sản phẩm";
                    } elseif (!empty($_POST['price']) && is_numeric(str_replace('.', '', $_POST['price'])) == false) {
                        $error = "Giá nhập không hợp lệ";
                    } elseif (empty($_POST['content'])) {
                        $error = "Bạn phải nhập mô tả sản phẩm";
                    }
                    if (isset($_FILES['image']) && !empty($_FILES['image']['name'][0])) {
                        $uploadedFiles = $_FILES['image'];
                        $result = uploadFiles($uploadedFiles);
                        if (!empty($result['errors'])) {
                            $error = $result['errors'];
                        } else {
                            $image = $result['path'];
                        }
                    }
                    if (isset($_FILES['gallery']) && !empty($_FILES['gallery']['name'][0])) {
                        $uploadedFiles = $_FILES['gallery'];
                        $result = uploadFiles($uploadedFiles);
                        if (!empty($result['errors'])) {
                            $error = $result['errors'];
                        } else {
                            $galleryImages = $result['uploaded_files'];
                        }
                    }
                    if (!isset($error)) {
                        $result = mysqli_query($con, "INSERT INTO `product` (`id`, `masp`, `name`, `image`, `price`, `content`, `created_time`, `last_updated`) VALUES 
                        ('" . $_POST['id'] . "', '" . $_POST['masp'] . "','" . $_POST['name'] . "','" . $image . "', " . str_replace('.', '', $_POST['price']) . ", '" . $_POST['content'] . "', " . date() . ", " . date() . ");");
                        if (!$result) {
                            $error = "Có lỗi xảy ra trong quá trình thực hiện.";
                        }
//                        else {
//                            if (!empty($galleryImages)) {
//                                $inserted_id = ($_GET['action'] == 'edit' && !empty($_GET['id'])) ? $_GET['id'] : $con->insert_id;
//                                $insertValues = "";
//                                foreach ($galleryImages as $path) {
//                                    if (empty($insertValues)) {
//                                        $insertValues = "(NULL, " . $inserted_id . ", '" . $path . "', " . time() . ", " . time() . ")";
//                                    } else {
//                                        $insertValues .= ",(NULL, " . $inserted_id . ", '" . $path . "', " . time() . ", " . time() . ")";
//                                    }
//                                }
//                                $result = mysqli_query($con, "INSERT INTO `image_library` (`id`, `product_id`, `path`, `created_time`, `last_updated`) VALUES " . $insertValues . ";");
//                            }
//                        }
                    }
                } else {
                    $error = "Bạn chưa nhập thông tin sản phẩm.";
                }
                ?>
                <head>
                    <title></title>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    
                    <link rel="stylesheet" type="text/css" href="../css/list.css" >
                    <script src="../resources/ckeditor/ckeditor.js"></script>
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
                    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" 
                    crossorigin="anonymous">
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
                    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>   
                </head>
                <div class = "container">
                    <div class="row">
                       <div class = "error fw-bolder" style = "margin-top: 20px; margin-bottom: 20px;"><?= isset($error) ? $error : "Cập nhật thành công" ?></div>
                        <a href = "product_listing.php">Quay lại danh sách sản phẩm</a>
                    </div> 
                </div>
            <?php } else { ?>
                <div class= "container fw-bolder" style="font-size: 16px;">
                    <form id="product-form" method="POST" action="?action=add"  enctype="multipart/form-data">
                        <button type="submit" title="Lưu sản phẩm" class="btn fw-bolder btn-success">LƯU SẢN PHẨM</button>
                            <div class="mb-3">
                                <label>NHẬP MÃ SẢN PHẨM</label>
                                <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Ví dụ: SP01">
                            </div>
                            <div class="mb-3">
                                <label>NHẬP TÊN SẢN PHẨM</label>
                                <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Hoa sinh nhật">
                            </div>
                            <div class="mb-3">
                                <label>CHỌN HÌNH ẢNH SẢN PHẨM</label>
                                <input type="file">
                            </div>
                            <div class="mb-3">
                                <label>NHẬP GIÁ SẢN PHẨM</label>
                                <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="700">
                            </div>
                            <div class="mb-3">
                                <label>NHẬP MÔ TẢ SẢN PHẨM</label>
                                <textarea name="content" id="product-content"></textarea>
                            </div>
                    </form>
                </div>
<!--                 
                <form id="product-form" method="POST" action="?action=add"  enctype="multipart/form-data">
                    <input type="submit" title="Lưu sản phẩm" value="" />
                    <div class="clear-both"></div>
                    <div class="wrap-field">
                        <label>Tên sản phẩm: </label>
                        <input type="text" name="name" value="" />
                        <div class="clear-both"></div>
                    </div>
                    <div class="wrap-field">
                        <label>Giá sản phẩm: </label>
                        <input type="text" name="price" value="" />
                        <div class="clear-both"></div>
                    </div>
                    <div class="wrap-field">
                        <label>Ảnh đại diện: </label>
                        <div class="right-wrap-field">
                            <input type="file" name="image" />
                        </div>
                        <div class="clear-both"></div>
                    </div> -->
                    <?php /*
                    <div class="wrap-field">
                        <label>Thư viện ảnh: </label>
                        <div class="right-wrap-field">
                            <input multiple="" type="file" name="gallery[]" />
                        </div>
                        <div class="clear-both"></div>
                    </div>*/?>
                    <!-- <div class="wrap-field">
                        <label>Nội dung: </label>
                        <textarea name="content" id="product-content"></textarea>
                        <div class="clear-both"></div>
                    </div>
                </form> -->
                <!-- <div class="clear-both"></div> -->
                <script>
                    // Replace the <textarea id="editor1"> with a CKEditor
                    // instance, using default configuration.
                    CKEDITOR.replace('product-content');
                </script>
            <?php } ?>
        </div>
    </div>

    <?php
}
include './footer.php';
?>
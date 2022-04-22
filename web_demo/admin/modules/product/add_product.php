<?php
if (!defined('hang')) {
    die('ban truy cap sai cach');
}
if (isset($_POST['sbm'])) {
    $prd_name = $_POST['sp_ten'];
    $prd_price = $_POST['sp_gia'];
    $prd_warranty = $_POST['sp_baohanh'];
    $prd_promotion = $_POST['sp_khmai'];
    $prd_image = $_FILES['sp_hinhanh']['name'];
    $tmp_name = $_FILES['sp_hinhanh']['tmp_name'];
    // move_uploaded_file($tmp_name, 'img/product/' . $prd_image);
    $cat_id = $_POST['dm_id'];
    $prd_status = $_POST['sp_trinhtrang'];
    if (isset($_POST['sp_noibat'])) {
        $prd_featured = $_POST['sp_noibat'];
    } else {
        $prd_featured = 0;
    }
    $prd_details = $_POST['sp_mota'];
    $sql = "INSERT INTO sanphams(
        sp_ten,
        sp_gia,
        sp_baohanh,
        sp_khmai,
        sp_hinhanh,
        dm_id,
        sp_trinhtrang,
        sp_noibat,
        sp_mota
    ) VALUE(
        '$prd_name',
        '$prd_price',
        '$prd_warranty',
        '$prd_promotion',
        '$prd_image',
        '$cat_id',
        '$prd_status',
        '$prd_featured',
        '$prd_details'
    )";
    if ($_FILES["sp_hinhanh"]["type"] != "image/jpeg" || $_FILES["sp_hinhanh"]["type"] != "image/png" || $_FILES["sp_hinhanh"]["type"] != "image/gif") {
        $error = '<div class="alert alert-danger">Ảnh không hợp lệ! Hãy chọn ảnh có định dạng jpg, png, gif</div>';
    }
    if (mysqli_num_rows(mysqli_query($conn, "SELECT*FROM sanphams WHERE sp_ten ='$prd_name'")) == 0) {
        if ($_FILES["sp_hinhanh"]["type"] == "image/jpeg" || $_FILES["sp_hinhanh"]["type"] == "image/png" || $_FILES["sp_hinhanh"]["type"] == "image/gif") {
            move_uploaded_file($tmp_name, "img/product/" . $prd_image);
            mysqli_query($conn, $sql);
            header("location: index.php?page_layout=product");
        }
        // else{
        //     $error = '<div class="alert alert-danger">Ảnh không hợp lệ! Hãy chọn ảnh có định dạng jpeg, png, gif</div>';
        // }
    } else {
        $error_name = '<div class="alert alert-danger">Tên sản phẩm đã tồn tại !</div>';
    }
}
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home">
                        <use xlink:href="#stroked-home"></use>
                    </svg></a></li>
            <li><a href="index.php?page_layout=product">Quản lý sản phẩm</a></li>
            <li class="active">Thêm sản phẩm</li>
        </ol>
    </div>
    <!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Thêm sản phẩm</h1>
        </div>
    </div>
    <!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-6">
                        <form role="form" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Tên sản phẩm</label>
                                <?php
                                if (isset($error_name)) {
                                    echo $error_name;
                                }
                                ?>
                                <input required name="sp_ten" class="form-control" placeholder="">
                            </div>
                            <div class="form-group">
                                <label>Giá sản phẩm</label>
                                <input required name="sp_gia" type="number" min="0" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Bảo hành</label>
                                <input required name="sp_baohanh" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Khuyến mãi</label>
                                <input required name="sp_khmai" type="text" class="form-control">
                            </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Ảnh sản phẩm</label>
                            <?php if (isset($error)) { echo $error;} ?>
                            <input required name="sp_hinhanh" type="file">
                            <br>
                            <div>
                                <img src="img/product/download.jpg">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Danh mục</label>
                            <select name="dm_id" class="form-control">
                                <?php
                                // $query=mysqli_query($conn, "SELECT*FROM category ORDER BY cat_id ASC");
                                $sql = "SELECT*FROM danhmucs ORDER BY dm_id ASC";
                                $query = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_array($query)) { ?>
                                    <option value=<?php echo $row['dm_id'] ?>><?php echo $row['dm_ten']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Trạng thái</label>
                            <select name="sp_trinhtrang" class="form-control">
                                <option value=1 selected>Còn hàng</option>
                                <option value=0>Hết hàng</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Sản phẩm nổi bật</label>
                            <div class="checkbox">
                                <label>
                                    <input name="sp_noibat" type="checkbox" value=1>Nổi bật
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Mô tả sản phẩm</label>
                            <textarea required name="sp_mota" id="product-content" class="form-control" rows="3"></textarea>
                            <script>
                                CKEDITOR.replace('product-content');
                            </script>
                        </div>
                        <button name="sbm" type="submit" class="btn btn-success">Thêm mới</button>
                        <button type="reset" class="btn btn-default">Làm mới</button>
                    </div>
                    </form>
                </div>
            </div>
        </div><!-- /.col-->
    </div><!-- /.row -->
</div>
<!--/.main-->
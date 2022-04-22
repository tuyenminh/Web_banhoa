<?php
if (!defined('hang')) {
    die('ban truy cap sai cach');
}
$prd_id=$_GET['id'];
$sql_prd="SELECT*FROM sanphams WHERE sp_id=$prd_id";
$query_prd=mysqli_query($conn, $sql_prd);
$row_prd=mysqli_fetch_array($query_prd);

    if(isset($_POST['sbm'])){
    $prd_name=$_POST['sp_ten'];
    $prd_price=$_POST['sp_gia'];
    $prd_warranty=$_POST['sp_baohanh'];
    $prd_promotion=$_POST['sp_khmai'];
    if($prd_image=$_FILES['sp_hinhanh']['name'] !=''){
        $prd_image=$_FILES['sp_hinhanh']['name'];
        $tmp_name=$_FILES['sp_hinhanh']['tmp_name'];
        move_uploaded_file($tmp_name,'img/product/'.$prd_image);
    }else{
        $prd_image=$row_prd['sp_hinhanh'];
    }

    $cat_id=$_POST['dm_id'];
    $prd_status=$_POST['sp_trinhtrang'];
    if(isset($_POST['sp_noibat'])){
        $prd_featured=$_POST['sp_noibat'];
    }else{ $prd_featured=0;}
    $prd_details=$_POST['sp_mota'];

    $sql="UPDATE sanphams SET 
    sp_ten='$prd_name',
    sp_gia='$prd_price',
    sp_baohanh='$prd_warranty',
    sp_khmai='$prd_promotion',
    sp_hinhanh='$prd_image',
    dm_id='$cat_id',
    sp_trinhtrang='$prd_status',
    sp_noibat='$prd_featured',
    sp_mota='$prd_details'
    WHERE sp_id='$prd_id'";
    $query=mysqli_query($conn, $sql);
    header('location: index.php?page_layout=product');
    }

?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home">
                        <use xlink:href="#stroked-home"></use>
                    </svg></a></li>
            <li><a href="index.php?page_layout=product">Quản lý sản phẩm</a></li>
            <li class="active"><?php echo $row_prd['sp_ten'];?></li>
        </ol>
    </div>
    <!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Sản phẩm: <?php echo $row_prd['sp_ten'];?></h1>
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
                                <input type="text" name="sp_ten" required class="form-control" value="<?php echo $row_prd['sp_ten'];?>" placeholder="">
                            </div>

                            <div class="form-group">
                                <label>Giá sản phẩm</label>
                                <input type="number" name="sp_gia" required value="<?php echo $row_prd['sp_gia'];?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Bảo hành</label>
                                <input type="text" name="sp_baohanh" required value="<?php echo $row_prd['sp_baohanh'];?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Khuyến mãi</label>
                                <input type="text" name="sp_khmai" required value="<?php echo $row_prd['sp_khmai'];?>" class="form-control">
                            </div>
                            

                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Ảnh sản phẩm</label>
                            <input type="file" name="sp_hinhanh">
                            <br>
                            <div>
                                <img src="img/product/<?php echo $row_prd['sp_hinhanh'];?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Danh mục</label>
                            <select name="dm_id" class="form-control">
                                <?php
                                $sql_cat="SELECT*FROM danhmucs";
                                $query_cat=mysqli_query($conn, $sql_cat);
                                while($row_cat=mysqli_fetch_array($query_cat)){?>
                                    <option <?php if($row_prd['dm_id']==$row_cat['dm_id']){echo 'selected';}?> value=<?php echo $row_cat['dm_id'];?>><?php echo $row_cat['dm_ten'];?></option>
                                <?php }?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Trạng thái</label>
                            <select name="sp_trinhtrang" class="form-control">
                                <!-- <option value=<?php echo $row_prd['sp_trinhtrang'];?>><?php if($row_prd['sp_trinhtrang']==0){ echo "Hết hàng";}else{echo 'Còn hàng';};?></option>
                                <option value=<?php echo $row_prd['sp_trinhtrang'];?>>Het hang</option> -->
                                <option <?php if($row_prd["sp_trinhtrang"]==1){echo "selected";}?> value=1>Còn hàng</option>
                                <option <?php if($row_prd["sp_trinhtrang"]==0){echo "selected";}?> value=0>Hết hàng</option>

                            </select>
                        </div>

                        <div class="form-group">
                            <label>Sản phẩm nổi bật</label>
                            <div class="checkbox">
                                <label>
                                    <input <?php if($row_prd['sp_noibat']==1){echo 'checked';} ?> name="sp_noibat" type="checkbox" value=1>Nổi bật
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Mô tả sản phẩm</label>
                            <textarea name="sp_mota" required class="form-control" id="product-content" rows="3"><?php echo $row_prd['sp_mota'];?></textarea>
                            <script>
                                CKEDITOR.replace('product-content');
                            </script>
                        </div>
                        <button type="submit" name="sbm" class="btn btn-primary">Cập nhật</button>
                        <button type="reset" class="btn btn-default">Làm mới</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.col-->
    </div>
    <!-- /.row -->

</div>
<!--/.main-->
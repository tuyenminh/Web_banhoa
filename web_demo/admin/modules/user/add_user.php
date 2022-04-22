<?php
if (!defined('hang')) {
    die('ban truy cap sai cach');
}
if(isset($_POST['sbm'])){
    $user_full=$_POST['user_full'];
    $user_mail=$_POST['user_mail'];
    $user_pass=$_POST['user_pass'];
    $user_re_pass=$_POST['user_re_pass'];
    $user_level=$_POST['user_level'];
    //pass
    if ($user_pass == $user_re_pass) {
        $user_pass = $_POST["user_pass"];
    } else {
        $error_pass = '<div class="alert alert-danger">Mat khau khong khop, hay thu mat khau khac</div>';
    }
    //mail
    //  $sql = "SELECT*FROM user";
    //  $query = mysqli_query($conn, $sql);
    //  while ($row = mysqli_fetch_array($query)) {
        if (mysqli_num_rows(mysqli_query($conn, "SELECT*FROM user WHERE user_mail = '$user_mail'")) == 0) {
            if ($user_pass == $user_re_pass) {
                $user_mail = $_POST["user_mail"];
                echo $sql_user = "INSERT INTO user( user_full, user_mail, user_pass, user_level) value( '$user_full', '$user_mail', '$user_pass', '$user_level' )";
                mysqli_query($conn, $sql_user);
                header("location: index.php?page_layout=user");
            }
        } else {
            $error = '<div class="alert alert-danger">Da ton tai Email ' . $user_mail . ', hay thu Email khac</div>';
        }
    //  }
}
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home">
                        <use xlink:href="#stroked-home"></use>
                    </svg></a></li>
            <li><a href="">Quản lý thành viên</a></li>
            <li class="active">Thêm thành viên</li>
        </ol>
    </div>
    <!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Thêm thành viên</h1>
        </div>
    </div>
    <!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-8">
                        <!-- <div class="alert alert-danger">Email đã tồn tại !</div> -->
                        <form role="form" method="post" enctype="multipart/form-data">

                            <div class="form-group">
                                <label>Họ & Tên</label>
                                <input name="user_full" required class="form-control" placeholder="">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <?php if (isset($error)) {
                                    echo $error;
                                } ?>
                                <input name="user_mail" required type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Mật khẩu</label>
                                <?php
                                if (isset($error_pass)) {
                                    echo $error_pass;
                                }
                                ?>
                                <input name="user_pass" required type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Nhập lại mật khẩu</label>
                                <input name="user_re_pass" required type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Quyền</label>
                                <select name="user_level" class="form-control">
                                    <option value=1>Admin</option>
                                    <option value=2>Member</option>
                                </select>
                            </div>
                            <button name="sbm" type="submit" class="btn btn-success">Thêm mới</button>
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
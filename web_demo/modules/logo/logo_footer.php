<?php
$sql="SELECT*FROM footer";
$query=mysqli_query($conn, $sql);
$row=mysqli_fetch_array($query);
?>
<h2><a href="#"><img class="img-fluid" src="admin/img/footer/<?php echo $row['logo']?>"></a></h2>
<p><?php echo $row['content_logo']?></p>
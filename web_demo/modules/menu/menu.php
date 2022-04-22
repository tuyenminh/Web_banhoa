<style>
    #menu-item1 {
        background: #a70e14;
    }
</style>
<nav>
    <div id="menu" class="collapse navbar-collapse">
        <ul>
            <?php
            $sql = "SELECT*FROM danhmucs ORDER BY dm_id ASC";
            $query = mysqli_query($conn, $sql);
            if (isset($_GET['id_category'])) {
            }
            while ($row = mysqli_fetch_array($query)) {
                if (isset($_GET['id_category'])) {
                    if ($row['dm_id'] == $_GET['id_category']) { ?>
                        <li id="menu-item1" class="menu-item"><a href="index.php?page_layout=category&id_category=<?php echo $row['dm_id']; ?>&dm_ten=<?php echo $row['dm_ten']; ?>"><?php echo $row['dm_ten']; ?></a></li>
                    <?php }
                    if ($row['dm_id'] != $_GET['id_category']) { ?>
                        <li class="menu-item"><a href="index.php?page_layout=category&id_category=<?php echo $row['dm_id']; ?>&dm_ten=<?php echo $row['dm_ten']; ?>"><?php echo $row['dm_ten']; ?></a></li>
                    <?php }
                } else { ?>
                    <li class="menu-item"><a href="index.php?page_layout=category&id_category=<?php echo $row['dm_id']; ?>&dm_ten=<?php echo $row['dm_ten']; ?>"><?php echo $row['dm_ten']; ?></a></li>
            <?php }
            }
            ?>
        </ul>
    </div>
</nav>
<div id="pagination">
<nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
        <span class="sr-only">Previous</span>
      </a>
    </li>
    <li class="page-item"><a class="page-link" href="">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item">
      <a class="page-link" href="?per_page=<?=$item_per_page?>&page=<?=$next_page?>" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
        <span class="sr-only">Next</span>
      </a>
    </li>
  </ul>
</nav>
<?php

if($current_page > 3){
	$first_page = 1;?>
	<a class="page-item" href="?per_page=<?=$item_per_page?>&page=<?=$first_page?>">First</a>
<?php }
if($current_page > 1){
	$prev_page = $current_page - 1;?>
	<a class="page-item" href="?per_page=<?=$item_per_page?>&page=<?=$prev_page?>">Prev</a>
<?php }
for($num = 1; $num <= $totalPages; $num++){?>
	<?php if($num != $current_page){ ?>
		<?php if($num >  $current_page - 3 && $num < $current_page + 3){?>
			<a class="page-item" href="?per_page=<?=$item_per_page?>&page=<?=$num?>"><?=$num?></a>
		<?php } ?>
	<?php }else{ ?>
		<strong class="current-page page-item"><?=$num?></strong>
	<?php } ?>
<?php }
if($current_page < $totalPages - 1){
	$next_page = $current_page + 1;?>
	<a class="page-item" href="?per_page=<?=$item_per_page?>&page=<?=$next_page?>">Next</a>
<?php }
if($current_page < $totalPages - 3){
	$end_page = $totalPages;?>
	<a class="page-item" href="?per_page=<?=$item_per_page?>&page=<?=$end_page?>">Last</a>
	<?php 
}
?>
</div>
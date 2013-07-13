<!--<span class = 'delete'>delete</span>
<span class='edit'>Edit</span>
<span class = 'add'>Add</span>-->
<?php 
$i = 0;
foreach ($span as $option) : 
	echo "<span class = '".$option."'>".$option."</span>";
	endforeach;
	$span = null;
?>

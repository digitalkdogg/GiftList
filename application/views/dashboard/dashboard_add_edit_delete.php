<!--<span class = 'delete'>delete</span>
<span class='edit'>Edit</span>
<span class = 'add'>Add</span>-->
<?php 
$i = 0;
foreach ($span as $option) : 
	echo "<a href = '#' class = '".$option." icon-pencil'></a>";
	endforeach;
	$span = null;
?>

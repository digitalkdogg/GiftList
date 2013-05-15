<?php
$response = array();
$name = $_POST['name'];

list($fname, $lname) = split(' ', $name,2);

$con = mysql_connect("giftlistkb.db.5445564.hostedresource.com","giftlistkb","Squogg27");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("giftlistkb", $con);
$return_arr = array();

$fetch = mysql_query("select * from owner where first_name = '" . $name . "'"); 
$num_rows = mysql_num_rows($fetch);
if ($num_rows > 0) :
	$found = true;
else:
	$fetch = mysql_query("select * from owner where last_name = '" . $name . "'"); 
	$num_rows = mysql_num_rows($fetch);
	if ($num_rows > 0) :
		$found = true;
	else:
		$fetch = mysql_query("select * from owner where first_name = '" . $fname . "' and last_name = '" . $lname . "'"); 
		$num_rows = mysql_num_rows($fetch);
		if ($num_rows > 0) :
			$found =true;
		else:
			$return_arr = array('found' => 'no');
		endif;
	endif;	
endif;


if ($found ==true):
	$return_arr = array('found' => 'yes');

while ($row = mysql_fetch_array($fetch, MYSQL_ASSOC)) {
    $row_array['id'] = $row['owner_id'];
    $row_array['first_name'] = $row['first_name'];
    $row_array['last_name'] = $row['last_name'];
	$row_array['html'] = "<a href = 'list.php/gift/" . $row['first_name'] . "'>" . $row['first_name'] . " " . $row['last_name'] . "</a>";

    array_push($return_arr,$row_array);
}
endif;
echo json_encode($return_arr);

mysql_close($con);

?>
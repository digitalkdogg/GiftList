<?php
$response = array();
$name = $_POST['name'];

list($fname, $lname) = split(' ', $name,2);

$con = mysql_connect("localhost","somedude","somepassword");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("somedatabase", $con);
$return_arr = array();

$fetch = mysql_query("select * from owner where first_name = '" . $name . "' or last_name = '" .$name . "'");
if (mysql_num_rows($fetch) > 0) {
	$return_arr = array('found' => 'yes');

 	while ($row = mysql_fetch_array($fetch, MYSQL_ASSOC)) {
    	 $row_array['id'] = $row['owner_id'];
     	$row_array['first_name'] = $row['first_name'];
     	$row_array['last_name'] = $row['last_name'];
 		$row_array['html'] = "<a href = 'list.php/gift/" . $row['first_name'] . "'>" . $row['first_name'] . " " . $row['last_name'] . "</a>";

    	array_push($return_arr,$row_array);
 	}
}

echo json_encode($return_arr);

mysql_close($con);

?>
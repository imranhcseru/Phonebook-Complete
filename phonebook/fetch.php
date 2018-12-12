<?php
require 'db_connect.php';
$output = '';
if(isset($_POST["query"]))
{
	$search = mysqli_real_escape_string($db_connect, $_POST["query"]);
	$query = "
	SELECT * FROM contact_info 
	WHERE fname LIKE '%".$search."%'
	OR address LIKE '%".$search."%' 
	OR lname LIKE '%".$search."%' 
	OR mobile LIKE '%".$search."%' 
	";
	$result = mysqli_query($db_connect,$query);
	$total_rows = mysqli_num_rows($result);
	if( $total_rows> 0){
	$output .= '<div class="table-responsive">
					<table class="table table bordered">
						<tr>
							<th>Name</th>
							<th>Address</th>
							<th>Mobile</th>
						</tr>';
	while($row = mysqli_fetch_array($result)){
		$output .= '
			<tr>
				<td>'.$row["fname"].' '.$row["lname"].'</td>
				<td>'.$row["address"].'</td>
				<td>'.$row["mobile"].'</td>
			</tr>
		';
	}
	echo $output;
	}
}
?>
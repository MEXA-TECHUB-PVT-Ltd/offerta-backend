<?php 
session_start();
include('../../include/connection.php');
header('Content-Type: application/json');

	$EncodeData=file_get_contents('php://input');
	$DecodeData=json_decode($EncodeData,true);
	
	$author_id=$DecodeData['author_id'];
	$sql="SELECT * FROM authors WHERE id='$author_id'";
	$run=mysqli_query($conn,$sql);
	if(mysqli_num_rows($run)>0) {
	    while($row=mysqli_fetch_assoc($run)) {
		 $response[]=array(
	 "key"=>$row['stripe_publish_key'],
	 "price"=>$row['ratePerNews'],
	 "email"=>$row['email'],
	    "error"=>false,
	    );    
		}
	} 
	else {
	    $response[]=array(
	 "key"=>"none",
	    "error"=>true,
	    );    
		}
	
	
		

	
	

	echo json_encode($response);
	
?>
<?php 
$user = "root";
$password = "Abc123456789";
$db = "course_info";


function search($words){
	$con = mysqli_connect("localhost",$GLOBALS['user'],$GLOBALS['password'],$GLOBALS['db']);
	$sql = "SELECT Course_Subject, Course_No FROM COURSE_INFO WHERE Course_Subject LIKE '$words%' AND Course_No LIKE '$words%'";
	
	
	
	$result = mysqli_query($con,$sql);
	while($row = mysqli_fetch_array($result))
	  {
	  echo $row['Course_Subject']. " " .$row['Course_No'].";";
	  }
	  return $words;
	  
	mysqli_close($con);
}
	
search($_POST['key']);
?>
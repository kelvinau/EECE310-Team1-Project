<?php
$user = "root";
$password = "Abc123456789";
$db = "course_info";

$con = mysqli_connect("localhost",$GLOBALS['user'],$GLOBALS['password'],$GLOBALS['db']);

$course_str = $_POST['course_str'];
$course_subject = substr($course_str,0,4);
$course_no = substr($course_str,4,3);
$course_section = substr($course_str,7);


$sql = "SELECT comment, date FROM comment_table WHERE Course_Subject = '".$course_subject."' AND Course_No = '".$course_no."' AND Course_Section = '".$course_section."' ORDER BY date DESC";
	
$result = mysqli_query($con,$sql);

$json = '{"comment": [';
$row = mysqli_fetch_array($result);
while($row){
	$json .= '{"date":"'.$row['date']
		  .'", "comment":"'.$row['comment']
		  .'"}';
	if ($row = mysqli_fetch_array($result))
	  	$json .= ','; 
}
$json .= ']}';

mysqli_close($con);
echo $json;

?>
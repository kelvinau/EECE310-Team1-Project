<?php 
error_reporting(E_ERROR | E_PARSE);

$user = "root";
$password = "Abc123456789";
$db = "course_info";

if ($_POST['key'] == null){
	if ($_POST['input'] != null )
		search_suggest();
}

function search_suggest(){
	$con = mysqli_connect("localhost",$GLOBALS['user'],$GLOBALS['password'],$GLOBALS['db']);
	$sql = "SELECT DISTINCT Course_Subject, Course_No FROM COURSES WHERE Course_Subject LIKE '". substr($_POST['input'],0,4)."%' AND Course_No LIKE '".substr($_POST['input'],4)."%'";
	
	$result = mysqli_query($con,$sql);
	
	$json = '{"course": [';
	$row = mysqli_fetch_array($result);
	while($row)
	  {
	  $json .= '"'.$row['Course_Subject'].$row['Course_No'].'"';
	  
	  if ($row = mysqli_fetch_array($result))
	  	$json .= ','; 
	  }
	$json .= ']}';
	
	echo $json;
	mysqli_close($con);
}

function result_search($key){
	$con = mysqli_connect("localhost",$GLOBALS['user'],$GLOBALS['password'],$GLOBALS['db']);
	$sql = "SELECT * FROM COURSES WHERE Course_Subject = '". substr($key,0,4)."' AND Course_No = '".substr($key,4)."'";
	
	$result = mysqli_query($con,$sql);
		
	$json = '{"array": [';
	$row = mysqli_fetch_array($result);
	while($row)
	  {

	  $json .= '{"Course_Subject":"'.$row['Course_Subject']
	  .'", "Course_No":"'.$row['Course_No']
	  .'", "Course_Section":"'.$row['Course_Section']
	  .'", "Title":"'.$row['Title']
	  .'", "Professor":"'.$row['Professor']
	  .'", "Enrolled":"'.$row['Enrolled']
	  .'", "Avg":"'.$row['Avg']
	  .'", "Std_dev":"'.$row['Std_dev']
	  .'", "Highest":"'.$row['Highest']
	  .'", "Lowest":"'.$row['Lowest']
	  .'", "Pass":"'.$row['Pass']
	  .'", "Fail":"'.$row['Fail']
	  .'", "Withdraw":"'.$row['Withdraw']
	  .'", "Audit":"'.$row['Audit']
	  .'", "Other":"'.$row['Other']
	  .'", "Marks0to9":"'.$row['Marks0to9']
	  .'", "Marks10to19":"'.$row['Marks10to19']
	  .'", "Marks20to29":"'.$row['Marks20to29']
	  .'", "Marks30to39":"'.$row['Marks30to39']
	  .'", "Marks40to49":"'.$row['Marks40to49']
	  .'", "MarksLessThan50":"'.$row['MarksLessThan50']
	  .'", "Marks50to54":"'.$row['Marks50to54']
	  .'", "Marks55to59":"'.$row['Marks55to59']
	  .'", "Marks60to63":"'.$row['Marks60to63']
	  .'", "Marks64to67":"'.$row['Marks64to67']
	  .'", "Marks68to71":"'.$row['Marks68to71']
	  .'", "Marks72to75":"'.$row['Marks72to75']
	  .'", "Marks76to79":"'.$row['Marks76to79']
	  .'", "Marks80to84":"'.$row['Marks80to84']
	  .'", "Marks85to89":"'.$row['Marks85to89']
	  .'", "Marks90to100":"'.$row['Marks90to100'].'"}';
	  
	  if ($row = mysqli_fetch_array($result))
	  	$json .= ','; 
	  }
	$json .= ']}';
	
	mysqli_close($con);
	
	//echo $json;
	return $json;
}
?>
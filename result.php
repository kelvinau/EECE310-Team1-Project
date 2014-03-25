<?php

$user = 'root';
$pass = 'Abc123456789';
$db = 'course_info';

$con = new mysqli('localhost',$user,$pass,$db) or die("Unable to connect to the database.");
/*
// Create table
$sql="CREATE TABLE COURSE_INFO"
		."(Title CHAR(30)," 
		."Professor CHAR(30)," 
		."Enrolled INT," 
		."Avg DOUBLE," 
		."Std_dev DOUBLE," 
		."Highest DOUBLE," 
		."Lowest DOUBLE," 
		."Pass INT,"
		."Fail INT,"
		."Withdraw INT,"
		."Audit INT,"
		."Other INT,"
		."Marks0to9 INT,"
		."Marks10to19 INT,"
		."Marks20to29 INT,"
		."Marks30to39 INT,"
		."Marks40to49 INT,"
		."MarksLessThan50 INT,"
		."Marks50to54 INT,"
		."Marks55to59 INT,"
		."Marks60to63 INT,"
		."Marks64to67 INT,"
		."Marks68to71 INT,"
		."Marks72to75 INT,"
		."Marks76to79 INT,"
		."Marks80to84 INT,"
		."Marks85to89 INT,"
		."Marks90to100 INT)";

// Execute query
if (mysqli_query($con,$sql))
  {
  echo "Table course_info created successfully";
  }
else
  {
  echo "Error creating table: " . mysqli_error($con);
  }
 */
 
 $result =  mysqli_query($con,"SELECT * from course_info");
  
 while ($row = mysqli_fetch_array($result)) {
 	echo $row['Title'] . " " . $row['Professor'];
 	echo "<br>";
 }
 
 
 mysqli_close($con);
 

//echo 'Hello ' . htmlspecialchars($_POST["input"]) . '!';

?>

<!doctype html>
<html>
<head>
		<meta charset="UTF-8">
		<title>PrePAIR Me</title>
		<h1 style = "text-align : center;"> <br>Result</h1>
		
<body style = "text-align:center">
<button onclick= "goBack()">Return</button>
</body>
<script>
function displayResult(){
}
function goBack(){
	history.back();
	
}

</script>
</head>
<body></body>
</html>
<?php

$user = "root";
$password = "Abc123456789";
$db = "course_info";

$con = mysqli_connect("localhost",$user,$password,$db);

$result = mysqli_query($con,"SELECT * FROM COURSE_INFO");

while($row = mysqli_fetch_array($result))
  {
  echo $row['Course_Subject'] . " " . $row['Course_No'] . " " . $row['Course_Section'] . " " . $row['Professor'];
  echo "<br>";
  }

mysqli_close($con);

if ($_POST["input"] != null)
	echo 'Search: ' . htmlspecialchars($_POST["input"]);

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
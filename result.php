<?php
//error_reporting(E_ERROR | E_PARSE);
include 'db.php';

$json = result_search($_POST['input']);
// parse this
?>

<!doctype html>
<html>
<head>
<script src="jquery-1.10.0.min.js"></script>		
<script>
function displayResult(){
	
	result = JSON.parse('<?php echo $json?>');
	//alert(result.array[1].Marks90to100);
	// 1. Create a table to put all the data
	// 2. Add user's comments - use accordion
}
function goBack(){
	history.back();
	
}
$(document).ready(function(){
	displayResult();
	
});


</script>

		<meta charset="UTF-8">
		<title>PrePAIR Me</title>
		<h1 style = "text-align : center;"> <br>Result</h1>

</head>

<body style = "text-align:center">
<button onclick= "goBack()">Return</button>
</body>

</html>
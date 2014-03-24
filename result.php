<?php

echo 'Hello ' . htmlspecialchars($_GET["INPUT"]) . '!';

?>

<!doctype html>
<html>
<head>
		<meta charset="UTF-8">
		<title>PrePAIR Me</title>
		<h1 style = "text-align : center;"> <br>Result</h1>
		
<body style = "text-align:center">
<h1  style= "font-size: 15px;"><i>No Result founded...Sorry</i> </h1>
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
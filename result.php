<?php
//error_reporting(E_ERROR | E_PARSE);
include 'db.php';

$json = result_search('EECE251');

?>

<!doctype html>
<html>
<head>
<script src="jquery-1.10.0.min.js"></script>		
<script src = "accordion.css" type="text/css" rel="stylesheet"></script>
<script src = "accordion.js"></script>
<script>
function displayResult(){
	
	result = JSON.parse('<?php echo $json?>');

	//alert(result.array.length );
	
	
	for (var i= 0 ; i <result.array.length;i++){
		var div_attrs = {
			'id': 'result' + i
		};
		$('#result').append( $('<div>',div_attrs));
		
		var content = "<table border = '1'>";
		content += "<tr>";
		$.each( result.array[i], function( key, value ) {
	 		 content += "<td>" + key +"</td>";
		});
		content += "</tr>";
		
		content += "<tr>";
		$.each( result.array[i], function( key, value ) {
	 		 content += "<td>" + value +"</td>";
		});
		content += "</tr>";
		
		content += "</table>";
		$('#result'+i).append(content);
		
		
		var button_attrs = {
			'style' :"float:left;",
			'onclick': 'showComment('+i+')',
			'text' : 'Show Comments'
		};
		$('#result'+i).append( $('<button>',button_attrs));
		
		$('#result').append("<br><br>");
	}


	// 2. Add user's comments - use accordion
}

function showComment(commentBox){
	alert("hi");
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
		<h1 style = "text-align : center;">Result</h1>

</head>

<body style = "text-align:center">
<div id = "result"></div>
<button onclick= "goBack()">Return</button>




</body>

</html>
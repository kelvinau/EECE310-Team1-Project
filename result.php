<?php
error_reporting(E_ERROR | E_PARSE);
include 'db.php';

//$json = result_search('EECE251');
$json = result_search($_POST['input']);

?>

<!doctype html>
<html>
<head>
<script src="jquery-1.10.0.min.js"></script>		
    <link href="bootstrap/dist/css/bootstrap.css" rel="stylesheet">  
    <link href="accordion.css" type="text/css" rel="stylesheet"/>   
<script>

var accordion_page = 1;
function slide(direction,totalComment){
	var to = accordion_page + direction;
	if (to != 0  && (to != 4 )){
		$("#accordion"+(accordion_page*5-4)).animate({width:'toggle'},800);
		$('#accordion'+(to*5-4)).show();
		
		$("#accordion"+(accordion_page*5-3)).animate({width:'toggle'},800);
		$('#accordion'+(to*5-3)).show();
		
		$("#accordion"+(accordion_page*5-2)).animate({width:'toggle'},800);
		$('#accordion'+(to*5-2)).show();
		
		$("#accordion"+(accordion_page*5-1)).animate({width:'toggle'},800);
		$('#accordion'+(to*5-1)).show();

		$("#accordion"+(accordion_page*5)).animate({width:'toggle'},800);
		$('#accordion'+(to*5)).show();
		accordion_page = to;
	}
	
}

function displayResult(){
	
	result = JSON.parse('<?php echo $json?>');

	//alert(result.array.length );
	
	
	for (var i= 0 ; i <result.array.length;i++){
		var numOfOneRowItem = 0;
		var div_attrs = {
			'id': 'result' + i
		};
		$('#result').append( $('<div>',div_attrs));
		
		var content = "<table border = '1'>";
		content += "<tr>";
		$.each( result.array[i], function( key, value ) {
			if (numOfOneRowItem < 13){
	 		 content += "<td><b>" + key +"</b></td>";
	 		 numOfOneRowItem++;
			}
		});
		content += "</tr>";
		
		numOfOneRowItem = 0;
		content += "<tr>";
		$.each( result.array[i], function( key, value ) {
			if (numOfOneRowItem<13){
	 		 content += "<td>" + value +"</td>";
	 		 numOfOneRowItem++;
			}
		});
		content += "</tr>";
		
		numOfOneRowItem = 0;
		content += "<tr><td></td><td></td><td></td>";
		$.each( result.array[i], function( key, value ) {
			if (numOfOneRowItem >= 13 && numOfOneRowItem< 23)
	 			content += "<td><b>" + key +"</b></td>";
			numOfOneRowItem++;
		});
		content += "</tr>";
		
		numOfOneRowItem = 0;
		content += "<tr><td></td><td></td><td></td>";
		$.each( result.array[i], function( key, value ) {
			if (numOfOneRowItem>=13 && numOfOneRowItem< 23)
	 			content += "<td>" + value +"</td>";
			numOfOneRowItem++;
		});
		content += "</tr>";
		
		numOfOneRowItem = 0;
		content += "<tr><td></td><td></td><td></td>";
		$.each( result.array[i], function( key, value ) {
			if (numOfOneRowItem >= 23)
	 			content += "<td><b>" + key +"</b></td>";
			numOfOneRowItem++;
		});
		content += "</tr>";
		
		numOfOneRowItem = 0;
		content += "<tr><td></td><td></td><td></td>";
		$.each( result.array[i], function( key, value ) {
			if (numOfOneRowItem>=23)
	 			content += "<td>" + value +"</td>";
			numOfOneRowItem++;
		});
		content += "</tr>";
		
		
		content += "</table>";
		$('#result'+i).append(content);
		
		var course_str = result.array[i].Course_Subject+result.array[i].Course_No+result.array[i].Course_Section;
		if (course_str.substring(7).localeCompare("OVERALL") != 0){
			var button_attrs = {
				'style' :"float:left;",
				'onclick': "showComment("+i+",'"+course_str+"')",
				'text' : 'Show Comments'
			};
			$('#result'+i).append( $('<button>',button_attrs));
		}
		
		$('#result').append("<br><br>");
	}

}

function showComment(result_num,course_str){
		if (!($('#commentSet'+result_num).length > 0)){
			$.post("db_getComment.php", {'course_str': course_str}, function(data){
				var totalComment = 0;
				result = JSON.parse(data);
				//alert(data);
				
			// Find the total number of comments	
			$.each( result.comment, function() {
		 		 totalComment++;
			});
			
			//alert(totalComment);
				
			var commentSet_attrs = {
				'class' : "bs-example",
				'id'	: "commentSet" + result_num
			};
				$('#result'+result_num).append( $('<div>',commentSet_attrs));
				
				var content = '<div class="panel-group">';
	
				for (var i = 0 ; i < totalComment && i < 5 ; i++){
					content += '<div style = " overflow : hidden;">';
		
					for (var j = 0,k= i+1 ; j < totalComment/5 + 1 && k <= totalComment; j++,k=k+5){
						content += '<div id = "accordion'+course_str+(k)+'" class="panel panel-default" ';
						if (j == 0)
							content += 'style = "float:left; width:100%;" >';
						else
							content += 'style = "display:none;">';
						content += '<div class="panel-heading">';
						content += '<h4 class="panel-title">';
						content += '<a data-toggle="collapse" href="#collapse'+course_str+k+'">';
						content += '<div class="accordionEventTitle">';
						content += '<div class="text">';
						content += '<h1><b>'+result.comment[k-1].date+'</b></h1>';
						content += '</div></div></a></h4></div>';
		
						content += '<div id="collapse'+course_str+k+'" class="panel-collapse collapse">';
						content += '<div class="panel-body">'
						content += '<p align="left">'+result.comment[k-1].comment+'</p></div></div></div>';
					}
					
					content += '</div>';
				}
	
				if (totalComment >= 6){
					content += '<div class= "carousel_number">';
					content += '<span><a class = "number" href = "#" onclick="slide(-1,'+totalComment+');return false;"><img src = "prev.png"></a></span>';
					content += '<span><a class = "number" href = "#" onclick="slide(1,'+totalComment+');return false;"><img src = "next.png"></a></span>';
				}
				content += '</div>';
				
				content += '<div style = "float:right;"><button onclick = "createTextBox('+"'"+course_str+"'"+','+result_num+');return false;">Add A Comment</button></div>';
				
				$('#commentSet'+result_num).append(content);
		
			});
		}
		else{
			$('#commentSet'+result_num).remove();
			accordion_page = 1;
		}
}

function createTextBox(course_str,result_num){
	if (!($('#'+course_str+'_TextBox').length > 0)){
		var content = '<div id = "'+course_str+'_TextBox"></div>';
		$('#commentSet'+result_num).append(content);
		
		content = '<textarea style = "width:100%;" rows = "4" id = "'+course_str+'_comment"></textarea>';
		content += '<button style = "float:right;" onclick = "addComment('+"'"+course_str+"'"+','+result_num+');return false;">Submit</button>';
		
		$('#'+course_str+'_TextBox').append(content);
	}
	else
		$('#'+course_str+'_TextBox').remove();
}

function addComment(course_str,result_num){
		$.post("db_addComment.php", {'course_str' : course_str,'comment': $("#"+course_str+"_comment").val()}, function(data){
		})
		.done(function(){
			alert("The comment is added!");
			$('#commentSet'+result_num).remove();
		}) 
		.fail(function(){
			alert("Cannot add the comment!");
		});

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

<body style = "text-align:center;background-color:#E6E6FA">
<div id = "result"></div>

<button onclick= "goBack()">Return</button>


    <script src="bootstrap/dist/js/bootstrap.js"></script> <!-- Change to botstrap.js for now -->

</body>

</html>
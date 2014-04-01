<?php
//error_reporting(E_ERROR | E_PARSE);
$user = "root";
$password = "Abc123456789";
$db = "course_info";

$con = mysqli_connect("localhost",$GLOBALS['user'],$GLOBALS['password'],$GLOBALS['db']);

//$course_str = "EECE251101";
$course_str = $_POST['course_str'];
$course_subject = substr($course_str,0,4);
$course_no = substr($course_str,4,3);
$course_section = substr($course_str,7);

//$comment = "I LIKE HIMMMMMMMM";
$comment = strip_tags($_POST['comment']);

date_default_timezone_set('America/Vancouver');

$sql  = "INSERT INTO comment_table (Course_Subject, Course_No, Course_Section, comment, date) ";
$sql .=	"VALUES('".$course_subject."',$course_no,'".$course_section."','".$comment."','".date('Y-m-d H:i:s')."')";

   if (!mysqli_query($con,$sql))
      {
      die('Error: ' . mysqli_error($con));
      }
    //echo "1 record added";
    
mysqli_close($con);

?>
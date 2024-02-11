<!DOCTYPE html>
<html>
<head>
	<title>ADD COURCES</title>
	<style>
		body {
			background-color: salmon;
			font-family: Arial, sans-serif;
		}
		h1 {
			text-align: center;
			font-size: 24px;
			margin-top: 20px;
		}
		table {
  /* Existing table styles */
  border-collapse: collapse;
  margin: 0 auto;
  width: 80%;
  max-width: 600px;
  background-color: skyblue;
  box-shadow: 0 2px 400px rgba(0,0,0,0.3);
  border-radius: 10px;
  margin-top: 20px;
  border: 2px solid black;
  transition: transform 1s ease-in-out;
}
table:hover {
  transform: scale(1.1);
}

		td, th {
			padding: 10px;
			border: 1px solid #ddd;
			text-align: left;
			font-size: 18px;
		}
		label {
			display: block;
			margin-bottom: 5px;
			font-weight: bold;
			font-size: 18px;
			color: #444;
		}
		input[type="text"] {
			padding: 10px;
			font-size: 16px;
			border: 1px solid #ccc;
			border-radius: 4px;
			width: 100%;
			max-width: 400px;
			box-sizing: border-box;
			margin-bottom: 10px;
		}
		input[type="submit"] {
			background-color: #4CAF50;
			color: #fff;
			border: none;
			border-radius: 10px;
			padding: 10px 20px;
			
			cursor: pointer;
			font-size: 20px;
			margin-top: 20px;
			float: right;
			transition: background-color 0.2s ease-in-out;
		}
		input[type="submit"]:hover {
			background-color: #3e8e41;
		}
		input[type="submit"]:active {
			background-color: #347e38;
			transform: translateY(1px);
		}
		

	</style>
	<script>
		function validateForm() {
			var course_id = document.forms["addCourseForm"]["course_id"].value;
			var title = document.forms["addCourseForm"]["title"].value;
			var dept_name = document.forms["addCourseForm"]["dept_name"].value;
			var credits = document.forms["addCourseForm"]["credits"].value;
			if (course_id == "" || title == "" || dept_name == "" || credits == "") {
				alert("Please fill in all fields.");
				return false;
			}
		}
	</script>
</head>
<body>
	<h1>ADD COURCES</h1>
	<form name="addCourseForm" action="add_course.php" method="post" onsubmit="return validateForm();">
		<table>
			<tr>
				<td><label>Course ID:</label></td>
				<td><input type="text" name="course_id"></td>
			</tr>
			<tr>
				<td><label>Title:</label></td>
				<td><input type="text" name="title"></td>
			</tr>
			<tr>
				<td><label>Department Name:</label></td>
				<td><input type="text" name="dept_name"></td>
			</tr>
			<tr>
				<td><label>Credits:</label></td>
				<td><input type="text" name="credits"></td>
			</tr>
			<tr>
				<td colspan="2"><input type="submit" name="save" value="Submit"></td>
			</tr>
		</table>
	</form>
	<?php
$servername="127.0.0.1";
$username="root";
$password="";
$database_name="university";


$conn=mysqli_connect($servername,$username,$password,$database_name);


if(!$conn)
{
    die("Connection Failed".mysqli_connect_error());
}
if(isset($_POST['save']))
{
    $course_id=$_POST['course_id'];
    $title=$_POST['title'];
    $dept_name=$_POST['dept_name'];
    $credits=$_POST['credits'];

    $sql_query = "INSERT INTO course (course_id,title,dept_name,credits) VALUES ('$course_id','$title','$dept_name','$credits') ";

    if (mysqli_query($conn, $sql_query)) 
    {
    echo "New Details Entry inserted successfully !";
    } 
    else
    {
    echo "Error: " . $sql . "" . mysqli_error($conn);
    }
    mysqli_close($conn);
}
?>
</body>
</html>

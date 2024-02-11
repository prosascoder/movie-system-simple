<!DOCTYPE html>
<html>
<head>
	<title>DATA BASE MANAGEMENT SYSTEM</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			margin: 0;
			padding: 0;
			background-color: grey;
		}
		.container {
			display: flex;
			flex-wrap: wrap;
			justify-content: center;
			align-items: center;
			height: 100vh;
		}
		.btn {
			display: flex;
			flex-direction: column;
			background-color: #fff;
			border-radius: 10px;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
			padding: 30px;
			text-align: center;
			margin: 20px;
			flex: 1;
			max-width: 300px;
		}
		.btn h1 {
			color: #333;
			font-size: 36px;
			margin-top: 0;
			margin-bottom: 20px;
		}
		.btn p {
			color: #666;
			font-size: 18px;
			margin-top: 20px;
		}
		.btn a {
			display: inline-block;
			margin-top: 20px;
			background-color: #008CBA;
			color: #fff;
			padding: 10px 20px;
			text-decoration: none;
			border-radius: 5px;
			transition: all 0.2s ease-in-out;
			font-size: 16px;
			font-weight: bold;
		}
		.btn a:hover {
			background-color: #004C7F;
			transform: translateY(-2px);
		}
		h1 {
			color: #fff;
			font-size: 48px;
			margin-top: 50px;
			text-align: center;
			text-shadow: 2px 2px #333;
			font-weight: bold;
		}
	</style>
</head>
<body>
    <h1>DATA BASE MANAGEMENT SYSTEM</h1>
    
	<div class="container">
		<div class="btn">
			<h1>ADD COURCES</h1>
			<p>This will lead to add cources in database</p>
			<a href="add_course.php">dashboard 1</a>
		</div>
		<div class="btn">
        <h1>UPDATE </h1>
			<p>This will lead to update information related to name ,cource etc </p>
			<a href="update_student1.php">dashboard 2</a>
		</div>
		<div class="btn">
			<h1>FILM INDUSTRY</h1>
			<p>This leads to searching for famous people like film stars and directors</p>
			<a href="movie_director.php">Search Film Industry</a>
		</div>
	</div>
</body>
</html>

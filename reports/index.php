<?php
	include('connection.php');
?>
<html>
<head>
<title>PHP Reports</title>
</head>
<body>
	<div class="container">
		<div class="wrapper">
			<h1>Reports in PHP</h1>
		</div>
		<div class="data">
			<form action="index.php" method="POST">
				<select name="date">
					<option>Select</option>
					<?php	
						$query = "SELECT date FROM invoice";
						$result = mysqli_query($query);
						while($rows=mysqli_fetch_assoc($result))
					?>
				</select>
				<input type="submit" name="submit" class="submit">
				
				<table border="1" class="table">
					<tr>
						<th>Student Name</th>
						<th>Gender</th>
					</tr>
				</table>
			</form>
		</div>
	</div>
</body>
</html>
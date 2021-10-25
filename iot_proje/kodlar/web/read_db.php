<!DOCTYPE html>
<html>
	<head>
		<style>
			table {
				border-collapse: collapse;
				width: 100%;
				color: #1f5380;
				font-family: monospace;
				font-size: 20px;
				text-align: left;
			} 
			th {
				background-color: #ff5380;
				color: white;
			}
			tr:nth-child(even) {background-color: #f2f2f2}
		</style>
	</head>
	<?php
		$hostname = "localhost";
		$username = "your_username";
		$password = "your_password";	
		$dbname = "your_db_name";
		$conn = mysqli_connect($hostname, $username, $password, $dbname);
		if (!$conn) {
			die("Connection failed !!!");
		} 
	?>
	<body>
		<table>
			<tr>
				<th>No</th> 
				<th>SICAKLIK DEĞERİ</th> 
				<th>TARİH</th>
				<th>SAAT</th>
			</tr>	
			<?php
				$table = mysqli_query($conn, "SELECT No, Temperature, Date, Time FROM nodemcu_temperature_table");
				while($row = mysqli_fetch_array($table))
				{
			?>
			<tr>
				<td><?php echo $row["No"]; ?></td>
				<td><?php echo $row["Temperature"]; ?></td>
				<td><?php echo $row["Date"]; ?></td>
				<td><?php echo $row["Time"]; ?></td>
			</tr>
			<?php
				}
			?>
		</table>
	</body>
</html>
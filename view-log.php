<html>
	<head>
		<title>Progress</title>
	</head>
		
	<body>
		<br>
		<h2 align="center">FAB & FIT</h2>
		<!--<br>-->
		<h2 align="center">View Your Progress</h2>
		<br><br>
		<form action="view-log.php" method="post">
			<table width ="1000" align="center">
				<tr>
					<th  align="center" colspan="2">Enter Member ID &ensp;&ensp;&ensp;:</th>
					<th  align="left"><input type="text" name="id"/></th>
				</tr>
			
				
				<tr><th><br></th></tr>
				<tr align="right">
					<th><input type="submit" name="button" value="Confirm" /></th>
					<th></th>
				</tr>
	
			</table>
		</form>
	</body>
	

	<?php
	
		if(isset($_POST["button"]))
		{
			$btn = $_POST["button"];
			if($btn=="Confirm")
			{
				$id=$_POST["id"];
				$id=$id+0;
				
				$db_sid = "(DESCRIPTION =(ADDRESS = (PROTOCOL = TCP)(HOST = DESKTOP-38NIC31)(PORT = 1521))(CONNECT_DATA =(SERVER = DEDICATED)(SERVICE_NAME = NOVEEN)))";            // Your oracle SID, can be found in tnsnames.ora  ((oraclebase)\app\Your_username\product\11.2.0\dbhome_1\NETWORK\ADMIN) 
  
				$db_user = "scott";   // Oracle username e.g "scott"
				$db_pass = "1234";    // Oracle password e.g "1234"
				$con = oci_connect($db_user,$db_pass,$db_sid); 
		
		
				if($con)
				{ 		
					//echo $pass." ";
					//echo gettype($pass);
					

					echo "Log File";
					echo '</br>';
							
					echo 'MEM_ID';
					echo "......";
					echo 'MUSCLEMASS';
					echo "......";
					echo 'WEIGHT';
					echo "......";
					echo 'HEIGHT';
					echo "......";
					echo 'CALORIES';
					echo "......";
					echo 'LOG_DATE';
					echo "......";
					echo 'NUTRIENTS_INTAKE';
					echo '</br>';
					echo '</br>';
								
								

					$q= "SELECT * FROM logs WHERE mem_id=$id";
	
					$query_id = oci_parse($con, $q);
					$r= oci_execute($query_id);
					

					if($r)
					{	
						while($row=oci_fetch_array($query_id, OCI_BOTH+OCI_RETURN_NULLS))
							
							{
								echo $row['MEM_ID'];
								echo "............................";
								echo $row['MUSCLEMASS'];
								echo ".......................";
								echo $row['WEIGHT'];
								echo "...................";
								echo $row['HEIGHT'];
								echo "...................";
								echo $row['CALORIES'];
								echo "...............";
								echo $row['LOG_DATE'];
								echo ".......";
								echo $row['NUTRIENTS_INTAKE'];
								
								echo '</br>';
								
							}
						
					}

					


					

				}
				
			}
		}
		
		
	?>
</html>
	
	
	
	
	
	
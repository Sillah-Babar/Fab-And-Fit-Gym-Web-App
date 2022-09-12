<html>
	<head>
		<title>Admin Panel</title>
	</head>
		
	<body>
		<br>
		<h2 align="center">FAB & FIT</h2>
		<!--<br>-->
		<h2 align="center">View All Members</h2>
		<br><br>
		<form action="all-members.php" method="post">
			<table width ="1000" align="center">
				<tr>
					<th  align="center" colspan="2">Enter Admin Password &ensp;&ensp;&ensp;:</th>
					<th  align="left"><input type="text" name="password"/></th>
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
				$pass=$_POST["password"];
				$pass=$pass+0;
				
				$db_sid = "(DESCRIPTION =(ADDRESS = (PROTOCOL = TCP)(HOST = DESKTOP-38NIC31)(PORT = 1521))(CONNECT_DATA =(SERVER = DEDICATED)(SERVICE_NAME = NOVEEN)))";            // Your oracle SID, can be found in tnsnames.ora  ((oraclebase)\app\Your_username\product\11.2.0\dbhome_1\NETWORK\ADMIN) 
  
				$db_user = "scott";   // Oracle username e.g "scott"
				$db_pass = "1234";    // Oracle password e.g "1234"
				$con = oci_connect($db_user,$db_pass,$db_sid); 
		
		
				if($con)
				{ 		
					//echo $pass." ";
					//echo gettype($pass);
					
					if($pass=="1234")
					{
							echo "All Members Enrolled";
							echo '</br>';
									
							echo 'MEM_ID';
							echo " ";
							echo 'AGE';
							echo " ";
							echo 'EMAIL_ID';
							echo " ";
							echo 'F_NAME';
							echo " ";
							echo 'L_NAME';
							echo " ";
							echo 'GENDER';
							echo " ";
							echo 'MEMBERSHIP_ID';
							echo " ";
							echo 'GOAL_ID';
							echo '</br>';
							echo '</br>';
										
										

							$q= "SELECT * FROM members";
			
							$query_id = oci_parse($con, $q);
							$r= oci_execute($query_id);
							

							if($r)
							{	
								while($row=oci_fetch_array($query_id, OCI_BOTH+OCI_RETURN_NULLS))
									
									{
										echo $row['MEM_ID'];
										echo " ";
										echo $row['AGE'];
										echo " ";
										echo $row['EMAIL_ID'];
										echo " ";
										echo $row['F_NAME'];
										echo " ";
										echo $row['L_NAME'];
										echo " ";
										echo $row['GENDER'];
										echo " ";
										echo $row['MEMBERSHIP_ID'];
										echo " ";
										echo $row['GOAL_ID'];
										
										echo '</br>';
										
									}
								
							}

					
					}
					else
					{
							echo "Incorrect Password";
					}

					

				}
				
			}
		}
		
		
	?>
</html>
	
	
	
	
	
	
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
		<form action="insert-equipment.php" method="post">
			<table width ="1000" align="center">
				<tr>
					<th  align="center" colspan="2">Enter Admin Password &ensp;&ensp;&ensp;:</th>
					<th  align="left"><input type="text" name="password"/></th>
				</tr>
			
				
				<tr>
					<th  align="center" colspan="2">Equipment Name &ensp;&ensp;&ensp;:</th>
					<th  align="left"><input type="text" name="name"/></th>
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

				$name=$_POST["name"];
				
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
						
						$q= "SELECT max(equip_id) AS MAXID FROM equipments";
						$query_id = oci_parse($con, $q);
						$r= oci_execute($query_id);
						
						if($r)
						{
								$row=oci_fetch_array($query_id, OCI_BOTH+OCI_RETURN_NULLS);
								$id=$row['MAXID'];
								$id=$id+1;
								
								
								
						}
					
						$QueryI="INSERT INTO equipments(equip_id,equip_name) VALUES ($id, '$name')";
						$Query_IID = oci_parse($con , $QueryI);
						$ExecuteI = oci_execute($Query_IID);

				
		
						if($ExecuteI)
						{	
							echo "<h3 align = center>Insertion Successful</h3>";
						}
						else
						{
							echo "ERROR";
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
	
	
	
	
	
	
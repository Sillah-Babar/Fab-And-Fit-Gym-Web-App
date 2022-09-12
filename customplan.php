
			<html>
			<head>
				<title>Custom Plan</title>
			</head>
				
			<body>
				<br>
				<h2 align="center">FAB AND FIT</h2>
				<!--<br>-->
				<h2 align="center">LOGIN FORM</h2>
				<br><br>
				<form action="customplan.php" method="post">
					<table width ="1000" align="center">
						<tr>
							<th  align="center" colspan="2">Member ID &ensp;&ensp;&ensp;:</th>
							<th  align="left"><input type="number" name="id"/></th>
						</tr>
						<tr>
							<th align="center" colspan="3"><h3>Current Measurements</th>
						</tr>

						<tr>
							<th  align="center" colspan="2">Weight in Pounds &ensp;&ensp;&ensp;:</th>
							<th  align="left"><input type="number" name="weight"/></th>
						</tr>
						<!--<tr><th><br></th></tr>-->
						<tr>
							<th  align="center" colspan="2">BMI &ensp;&ensp;:</th>
							<th  align="left"><input type="number" name="bmi"/></th>
						</tr>
						<!--<tr><th><br></th></tr>-->
						<tr>
							<th  align="center" colspan="2">Muscle Mass Percentage&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;:</th>
							<th  align="left"><input type="number" name="musclemass"/></th>
						</tr>
						<!--<tr><th><br></th></tr>-->
						
						<tr>
							<th align="center" colspan="3"><h3>Ideal Measurements</th>
						</tr>

						<tr>
							<th  align="center" colspan="2">Weight in Pounds &ensp;&ensp;&ensp;:</th>
							<th  align="left"><input type="number" name="weight2"/></th>
						</tr>
						<!--<tr><th><br></th></tr>-->
						<tr>
							<th  align="center" colspan="2">BMI &ensp;&ensp;:</th>
							<th  align="left"><input type="number" name="bmi2"/></th>
						</tr>
						<!--<tr><th><br></th></tr>-->
						<tr>
							<th  align="center" colspan="2">Muscle Mass Percentage&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;:</th>
							<th  align="left"><input type="number" name="musclemass2"/></th>
						</tr>
						<!--<tr><th><br></th></tr>-->

						
						
						
						<tr><th><br></th></tr>
						<tr align="right">
							<th><input type="submit" name="button" value="Confirm" /></th>
							<th></th>
						</tr>
					</table>
				</form>
			</body>
			
			
			
			
			
			
			<?php
			$db_sid = "(DESCRIPTION =(ADDRESS = (PROTOCOL = TCP)(HOST = DESKTOP-38NIC31)(PORT = 1521))(CONNECT_DATA =(SERVER = DEDICATED)(SERVICE_NAME = NOVEEN)))";   // Your oracle SID, can be found in tnsnames.ora  ((oraclebase)\app\Your_username\product\11.2.0\dbhome_1\NETWORK\ADMIN) 
		  
		   $db_user = "scott";   // Oracle username e.g "scott"
		   $db_pass = "1234";    // Password for user e.g "1234"
		   $con = oci_connect($db_user,$db_pass,$db_sid); 
		   if($con) 
			  { //echo "Oracle Connection Successful."; 
		  		if(isset($_POST["button"]))
				{

					$btn = $_POST["button"];
					if($btn=="Confirm")
					{

						$mem_id=$_POST["id"]+0;
						
						$weight1=$_POST["weight"]+0;
						$weight2=$_POST["weight2"];
						
						$musclemass1=$_POST["musclemass"];
						$musclemass2=$_POST["musclemass2"];
						
						$bmi1=$_POST["bmi"];
						$bmi2=$_POST["bmi2"];
						
						
						
						#echo $mem_id,$weight1, $weight2, $musclemass1, $musclemass2, $bmi1, $bmi2;
						
						if($weight1>$weight2)
						{
								$newgoal=2;
								echo "Changing goal to weight loss!";
								
						}
						else if (($musclemass1<$musclemass2)or($bmi1<$bmi2))
						{
								$newgoal=3;
								echo "Changing goal to muscle gain!";
								
						}
						else
						{
								$newgoal=1;
								echo "Changing goal to staying fit!";

						}
						
						
						$q="UPDATE members SET goal_id=$newgoal WHERE mem_id=$mem_id";
						$Query_ID = oci_parse($con , $q);
						$ExecuteI = oci_execute($Query_ID);
						
						if($ExecuteI)
						{	
							echo "<h3 align = center>Goal Updated</h3>";
						}
						else
						{
							echo "ERROR";
						}
						
						$q2= "SELECT membership_id AS ID FROM members WHERE mem_id=$mem_id";
						$query_id2 = oci_parse($con, $q2);
						$r2= oci_execute($query_id2);
						
						$membership_id=0;
						if($r2)
						{
								$row2=oci_fetch_array($query_id2, OCI_BOTH+OCI_RETURN_NULLS);
								$membership_id=$row2['ID'];
								
						}
						
						
						//Update workout
						
						if($newgoal==3 && $membership_id==3)
						{
								echo "New workout plan is Plan #3";
								$newplan=3;
						}
						else if($newgoal==2 && $membership_id==3)
						{
								echo "New workout plan is Plan #2";
								$newplan=2;
						}						
						else if($newgoal==1 && $membership_id==1)
						{
								echo "New workout plan is Plan #4";
								$newplan=4;
						}						
						else if($newgoal==2 && $membership_id==1)
						{
								echo "New workout plan is Plan #5";
								$newplan=5;
						}
						else if($newgoal==3 && $membership_id==2)
						{
								echo "New workout plan is Plan #6";
								$newplan=6;
						}
					
						$q2="UPDATE members SET workout_id=$newplan WHERE mem_id=$mem_id";
						$Query_IID = oci_parse($con , $q2);
						$ExecuteII = oci_execute($Query_IID);
						
						if($ExecuteII)
						{	
							echo "<h3 align = center>Plan Updated</h3>";
						}
						else
						{
							echo "ERROR";
						}
						
						
		
						
					}
				}
			  } 
		   else 
			  { die('Could not connect to Oracle: '); 
			  } 
			

				
			?>
		</html>
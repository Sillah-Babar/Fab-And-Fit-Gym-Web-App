<html>
	<head>
		<title>Registration Form</title>
	</head>
		
	<body>
		<br>
		<h2 align="center">FAB & FIT</h2>
		<!--<br>-->
		<h2 align="center">MEMBER REGISTRATION</h2>
		<br><br>
		<form action="registration.php" method="post">
			<table width ="1000" align="center">
				<tr>
					<th align="center" colspan="3"><h3>Personal Information</h3></th>
					<th  align="left" rowspan="5"><img src="https://d1csarkz8obe9u.cloudfront.net/posterpreviews/gym-logo-template-design-04d583c8ca3558ea0ea21763a57e7ba6_screen.jpg?ts=1604496976" alt="Logo" width="400" height="300"></th>
				</tr>
				<!--<tr><th><br></th></tr>-->

				<tr>
					<th  align="center" colspan="2">First Name &ensp;&ensp;&ensp;:</th>
					<th  align="left"><input type="text" name="FName"/></th>
				</tr>
				<tr>
					<th  align="center" colspan="2">Last Name &ensp;&ensp;&ensp;:</th>
					<th  align="left"><input type="text" name="LName"/></th>
				</tr>
				<!--<tr><th><br></th></tr>-->
				<tr>
					<th  align="center" colspan="2">Age &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;:</th>
					<th  align="left"><input type="number" name="Age"/></th>
				</tr>


				<!--<tr><th><br></th></tr>-->
				<tr>
					<th  align="center" colspan="2">Email ID&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;:</th>
					<th  align="left"><input type="text" name="EmailID"/></th>
				</tr>

				
				<!--<tr><th><br></th></tr>-->
				<tr>
				<th align="center" colspan="2">
					<br><br>
					<label for="Gender">Gender:</label>
					<select id="Gender" name="Gender" size="2">
					  <option value="female">Female</option>
					  <option value="male">Male</option>

					</select>
				</th>
				</tr>
				
				<!--<tr><th><br></th></tr>-->
				<tr>
				<th align="center" colspan="2">
					<br><br>
					<label for="Goal">What is your goal? </label>
					<select id="Goal" name="Goal" size="3">
					  <option value="1">Stay Healthy</option>
					  <option value="2">Lose Weight</option>
					  <option value="3">Gain Muscle Mass</option>

					</select>
				</th>
				</tr>
				
				<!--<tr><th><br></th></tr>-->
				<tr>
				<th align="center" colspan="2">
					<br><br>
					<label for="Membership">Which membership do you want? </label>
					<select id="Membership" name="Membership" size="3">
					  <option value="1">Standard</option>
					  <option value="2">Deluxe</option>
					  <option value="3">Premium</option>

					</select>
				</th>
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
				
				$fname = $_POST["FName"];
				$lname = $_POST["LName"];
				$age = $_POST["Age"];
				$gender = $_POST["Gender"];
				$email = $_POST["EmailID"];
				$goal = $_POST["Goal"];
				$membership = $_POST["Membership"];
				$mem_id;
				
				$db_sid = "(DESCRIPTION =(ADDRESS = (PROTOCOL = TCP)(HOST = DESKTOP-38NIC31)(PORT = 1521))(CONNECT_DATA =(SERVER = DEDICATED)(SERVICE_NAME = NOVEEN)))";            // Your oracle SID, can be found in tnsnames.ora  ((oraclebase)\app\Your_username\product\11.2.0\dbhome_1\NETWORK\ADMIN) 
  
				$db_user = "scott";   // Oracle username e.g "scott"
				$db_pass = "1234";    // Oracle password e.g "1234"
				$con = oci_connect($db_user,$db_pass,$db_sid); 
		
		
				if($con)
				{ 		
					
					
					$q= "SELECT max(mem_id) AS MAXID FROM members";
					$query_id = oci_parse($con, $q);
					$r= oci_execute($query_id);
					
					if($r)
					{
							$row=oci_fetch_array($query_id, OCI_BOTH+OCI_RETURN_NULLS);
							$mem_id=$row['MAXID'];
							$mem_id=$mem_id+1;
							
							
							
					}
					//echo $mem_id,$fname, $lname, $age, $gender, $email, $membership, $goal;
					
					
					
					$QueryI="INSERT INTO members(mem_id, f_name,l_name,age,gender,email_id,membership_id,goal_id) VALUES ($mem_id,'$fname', '$lname', $age, '$gender', '$email', $membership, $goal)";
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
					
					
						$membership_id=$membership;
						$newgoal=$goal;
						
						
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
					
						$queryupdate="UPDATE members SET workout_id=$newplan WHERE mem_id=$mem_id";
						$qupdateid = oci_parse($con , $queryupdate);
						$exupdate = oci_execute($qupdateid);
						
						if($exupdate)
						{	
							echo "<h3 align = center>Plan Updated</h3>";
						}
						else
						{
							echo "ERROR";
						}
					
				}
				else
				{
					echo "ORACLE NOT CONNECTED";
				}

				
			}
		}
		
		
	?>
</html>
	
	
	
	
	
	
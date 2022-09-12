
			<html>
			<head>
				<title>Exercise Search</title>
			</head>
				
			<body>
				<br>
				<h2 align="center">FAB AND FIT</h2>
				<!--<br>-->
				<h2 align="center">EXERCISE SEARCH</h2>
				<br><br>
				<form action="ex-search.php" method="post">
					<table width ="1000" align="center">
				<!--<tr><th><br></th></tr>-->
				<tr>
				<th align="center" colspan="5">
					<br><br>
					<label for="Exercise"></label>
					<select id="Exercise" name="Exercise" size="41">
					  <option value=1>Cobra Stretch</option>
					  <option value=2>Knees to Chest</option>
					  <option value=3>Spinal Twist</option>
					  <option value=4>Upper Back Stretch</option>
					  <option value=5>Neck Stretch</option>
					  <option value=6>Shoulder Stretch</option>
					  <option value=7>Side Stretch</option>
					  <option value=8>Standing Quad Stretch</option>
					  <option value=9>Hamstring Stretch</option>
					  <option value=10>Calf Stretch</option>
					  <option value=11>Tightrope Walk</option>
					  <option value=12>Rock the Boat</option>
					  <option value=13>Falmingo Stand</option>
					  <option value=14>Bean Bag Balance</option>
					  <option value=15>Banded Triplanar Toe Taps</option>
					  <option value=16>One leg cross punches</option>
					  <option value=17>Paloff Rotation Press</option>
					  <option value=18>Jump Rope</option>
					  <option value=19>Stationary Bike</option>
					  <option value=20>Elliptical</option>
					  <option value=21>Cardio Kickboxing</option>
					  <option value=22>Zumba</option>
					  <option value=23>Indoor Cycling</option>
					  <option value=24>Goblet Squat</option>
					  <option value=25>Thruster Squat</option>
					  <option value=26>Plank Rows</option>
					  <option value=27>Overhead Tricep Extension</option>
					  <option value=28>Hammer Curls</option>
					  <option value=29>Push Ups</option>
					  <option value=30>Walking Lunges</option>
					  <option value=31>Bench Press</option>
					  <option value=32>Bent-Over Row</option>
					  <option value=33>Dips</option>
					  <option value=34>Chest Press</option>
					  <option value=35>Incline Dumbbell Press</option>
					  <option value=36>Pull-Up</option>
					  <option value=37>Chin-Up</option>
					  <option value=38>Triceps Dip</option>
					  <option value=39>Biceps Curl</option>
					  <option value=40>Back Squat</option>
					  <option value=41>Shoulder Press</option>
					</select>
				</th>
				</tr>
				
				<tr><th><br></th></tr>
				<tr align="center">
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
						$exercise = $_POST["Exercise"];
						$exercise = $exercise+0; //Converting it to an integer
						
						//echo $exercise." ";
						//echo gettype($exercise);
						$q= "SELECT ex_desc FROM exercises WHERE ex_id=$exercise";
						//echo $q." ";
								
						$query_id = oci_parse($con, $q);
						$r= oci_execute($query_id);
						

						if($r)
						{	
								$row=oci_fetch_array($query_id, OCI_BOTH+OCI_RETURN_NULLS);
								echo $row['EX_DESC'];
								
						}
		
						
					}
				}
			  } 
		   else 
			  { die('Could not connect to Oracle: '); 
			  } 
			

				
			?>
		</html>
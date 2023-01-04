<head> 
  <title>Login</title> 
  </head> 
  <body>
  <H1>Login to Fast Cars as Driver</H1>

  <form method="post" action ="driver.php">
  <table>
<tr>
<td><label>Username:</label></td> <td><input type="text" name="dusername" maxlength="30"></td>
</tr><tr>
<td><label>License Number:</label></td> <td><input type="int" name="dlicenseno"  maxlength="30"></td>
</tr><tr>	

</tr><tr>
<text> Login as Customer : </text> <a href = "login.php">Login</a><br>	  
	    <td></td><td><button type="submit" name="submit">Submit</button></td>
</tr>
  </table>
  </form>



<?php 
 //connect to mysql server
include ('db_conn.php');
session_start();
//get password and e-mail passed from client
if (isset($_POST['submit'])) 
	{
		$dusername = $_POST['dusername'];
		$dlicenseno = $_POST['dlicenseno'];

//check whether the user input the password and username
	if (empty($dusername) or empty($dlicenseno)) {
	echo "Please fill in your username and password.<br>";
   	} 
//validate username
   	// elseif (filter_var($username, FILTER_VALIDATE_USERNAME) == true && $password) {
		// elseif (filter_var($username)) {
		else {
	//access date to database and search by username
	$query = "SELECT * from driver where CONCAT(firstName, ' ',lastName) = '$dusername'";
	$result = @mysqli_query($conn,$query)
	Or die ("<p>Unable to query the table.</p>"."<p>Error code ".
	mysqli_errno($conn). ": ".mysqli_error($conn)). "</p>";
			$row = mysqli_fetch_array($result);
			if ($dusername !== $row['firstName'] . " " . $row['lastName']) { // check username whether the member exists
			echo "The member does not existed. Please register.<br>";
			}
			elseif ($dlicenseno == $row['dlicenseNo']) { //check whether the password is matched 
				 	// if ($row[5]=="admin") { //check if the role is admin
						$_SESSION['did']=$row['did'];
				echo "The log-in is success. You will be directed to the administration page shortly."; 
		// 			sleep(3);
		// //store session data
		// 			ob_start();
		// 			session_start();
		// 			//session_register('useremail'); //outdated
		// 			$_SESSION ['username'] =  $username;
		// 			session_write_close();	

		// 			$URL="admin.php";  
		// 			header ("Location: $URL"); 
		// 			exit; 
		// 		 	} else {
		// 			echo "The log-in is success. You will be directed to the booking page shortly."; 
		// 			sleep(3);
		//store session data
				

				 
					header ("Location:homeD.php"); 
					exit; 
		}
			 else {
			echo "The password is incorrect. Please try again.<br>";
		}
	//  else { echo "Please input a valid email and try again.<br>";}
	mysqli_close($conn);	
		}
	}
?>
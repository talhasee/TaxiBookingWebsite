<head> 
  <title>Login</title> 
  </head> 
  <body>
  <H1>Login to Fast Cars</H1>

  <form method="post" action ="login.php">
  <table>
<tr>
<td><label>Username:</label></td> <td><input type="text" name="username" maxlength="30"></td>
</tr><tr>
<td><label>Password:</label></td> <td><input type="text" name="password"  maxlength="30"><input type="hidden"></td>
</tr><tr>	
</tr><tr>	  
	    <td></td><td><button type="submit" name="submit">Submit</button></td>
</tr>
  </table>
  </form>
  <b> New Member? </b>  <a href="register.php">Register now</a><br><br>
  <text> Login as Driver : </text> <a href = "driver.php">Login</a><br>
  </body> 

<?php 
 //connect to mysql server
include ('db_conn.php');
session_Start();
//get password and e-mail passed from client
if (isset($_POST['submit'])) 
	{
		$username = $_POST['username'];
		$password = $_POST['password'];

//check whether the user input the password and username
	if (empty($password) or empty($username)) {
	echo "Please fill in your username and password.<br>";
   	} 
			else{
	$query = "SELECT * from customer where username = '$username'";
	$result = @mysqli_query($conn,$query)
	Or die ("<p>Unable to query the table.</p>"."<p>Error code ".
	mysqli_errno($conn). ": ".mysqli_error($conn)). "</p>";
			$row = mysqli_fetch_row($result);
			if ($username !== $row[1]) { // check username whether the member exists
				$_SESSION['cid'] = $row[0];
			echo "The member does not existed. Please register.<br>";
			}
			elseif ($password == $row[5]) { //check whether the password is matched 
				 	// if ($row[5]=="admin") { //check if the role is admin
				echo "The log-in is success. You will be directed to the driver page shortly."; 	 
					header ("Location:home.php"); 
					exit; 
		}
			 else {
			echo "The password is incorrect. Please try again.<br>";
		}
	mysqli_close($conn);	
		}
	}
?>
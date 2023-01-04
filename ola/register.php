<head> 
  <title>Registration</title> 
  </head> 
  <body>
  <H1>Register to FastCars</H1>
  <form action ="register.php" method="post">
  <p>Please fill the fields below to complete your signup</p> 
   <table>
<tr>
	   <td><label>Username:</label></td> <td><input type="text" name="username" maxlength="30"></td>
</tr><tr>
 	   <td><label>Password:</label></td> <td><input type="text" name="password"  maxlength="30"></td>
</tr><tr>
	   <td><label>Phone Number:</label></td> <td><input type="text"   name="phoneNum" maxlength="11"><br></td>
</tr><tr>
	   <td><label>Date Of Birth</label></td> <td><input type="date"   name="dob"><br></td>
</tr><tr>
	   <td></td><td><button type="reset" value="Reset">Reset</button><button type="submit" name="submit">Submit</button></td>
</tr>
  </table>
  </form>
  <b>Already registered? </b>  <a href="login.php">Login here</a><br><br>
  </body> 

<?php 

include ('db_conn.php');

//get name, password, e-mail and contact number passed from client
if (isset($_POST['submit'])) 
	{
	$username = $_POST['username'];
	$password = $_POST['password'];
	$phoneNum = $_POST['phoneNum'];
    $dob = $_POST['dob'];


//validate the name
	if (empty($username)) {
	echo "Please fill in your name.<br>";
   	} else {
	$username = $_POST['username'];

	}

//validate password
	if (empty($password)) {
	echo "Please fill in your password.<br>";
	} else {
		$password = $_POST['password'];
		
	}
    
	
//validate phoneNum
	if (empty($phoneNum)) {
	echo "Please fill in your contact phoneNum number.<br>";
   	} elseif (is_numeric($phoneNum)) {
	$phoneNum = $_POST['phoneNum'];
	
	} else { 
	echo "Please fill in a valid contact number.<br>";
	}

//validate dob
	if (empty($dob)) {
        echo "Please fill in your date of bbirth.<br>";
    } else {
        $dob = $_POST['dob'];
       
     }

//write to database of customer table

// $trigger = "CREATE TRIGGER trigga BEFORE INSERT ON customer FOR EACH ROW SET NEW.username = TRIM(NEW.username)";
// $result2 = @mysqli_query($conn,$trigger)
// Or die ("<p>2.Unable to query the table.</p>"."<p>Error code ".mysqli_errno($conn). ": ".mysqli_error($conn). "</p>");

$query = "INSERT INTO customer (username, password, phoneNum, dob ) VALUES ('$username','$password','$phoneNum','$dob')";
$result= @mysqli_query($conn,$query)
Or die ("<p>2.Unable to query the table.</p>"."<p>Error code ".mysqli_errno($conn). ": ".mysqli_error($conn). "</p>");
if (mysqli_affected_rows($conn) == 1) {
       echo "Thank you. The registration is now complete. You may now <a href='login.php'>Log In</a> here."; 
      }
  mysqli_close($conn);
}
?>
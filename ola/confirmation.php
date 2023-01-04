<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php 
    include "links.php"; 
    include "db_conn.php"
    ?>
    <title>Details Confirmation</title>
</head>
<body>
        <h3 class="display-3     text-left text-muted my-1"><?php echo "Details Confirmation";
            session_start();
        ?> </h3>
        <div class="card" style="width: 18rem;">
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><?php echo "Source: " . $_SESSION['src']; ?></li>
                <li class="list-group-item"><?php echo "Destination: " . $_SESSION['dest']; ?></li>
                <li class="list-group-item"><?php echo "Driver Name: " . $_SESSION['dname']; ?></li>
                <li class="list-group-item"><?php echo "Driver Phone Number: " . $_SESSION['dpn']; ?></li>
                <li class="list-group-item"><?php echo "Type of Car Selected: " . $_SESSION['carname']; ?></li>
                <li class="list-group-item"><?php echo "Charge Per Km: " . $_SESSION['chargePerKm']; ?></li>
                <li class="list-group-item"><?php echo "Total Charge: " . $_SESSION['pmoney']; ?></li>
            </ul>
        </div>
        <h3 class="display-3     text-left text-muted my-1">
            <?php 

            $_SESSION['toa']=rand(5,15);                       // time of arrival 
            echo "Time of arrival of driver after confirmation: 5 Seconds";
        ?> </h3>
        <form action="" method="POST">
        <input type="submit" value="confirmed, continue" name="conf">
        </form>
        <a href="home.php" class="btn btn-primary">Exit</a>
        <?php
            if(isset($_POST["conf"])){
                $src=$_SESSION['src'];
                $src=$_SESSION['dest'];
                $srcArray = explode("/", $_SESSION['src']);
                $destArray = explode("/", $_SESSION['dest']);
                $srcBlock = $srcArray[0];
                $srcCity = $srcArray[1];
                $srcState = $srcArray[2];
                $destBlock = $destArray[0];
                $destCity = $destArray[1];
                $destState = $destArray[2];
                $cid = $_SESSION['cid'];
                $pmoney = $_SESSION['pmoney'];
                $did = $_SESSION['did'];
                $query="INSERT INTO `ride` (`cid`, `startTime`, `price`, `otp`, `status`, `did`) VALUES ('$cid', NOW(), '$pmoney', FLOOR(RAND()*(4999-1000+1))+1000, 2, '$did')";
                $result =mysqli_query($conn, $query);
                $query = "select count(*) from ride";
                $result=mysqli_query($conn, $query);
                $row=mysqli_fetch_array($result);
                $_SESSION['rid']=$row['count(*)'];
                $rid=$_SESSION['rid'];
                echo $rid;
                $query = "INSERT INTO `customersrcdest` (`rid`, `srcBlock`, `srcCity`, `srcState`, `destBlock`, `destCity`, `destState`) VALUES ('$rid', '$srcBlock', '$srcCity', '$srcState', '$destBlock', '$destCity', '$destState')";
                $result = mysqli_query($conn, $query);
               header("Location: arrival.php");



            }
            ?>
</body>
</html>








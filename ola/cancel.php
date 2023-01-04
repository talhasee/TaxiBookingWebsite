<!DOCTYPE html>
<html>
<head>
    <title> LO</title>
    <link rel="stylesheet"  href="styleC.css">
    <?php include "db_conn.php";
        session_start();
    ?>
</head>
<body>
    <form action="" method="post">
        <h2>RIDE CANCELLED</h2>
        <p> Cancellation charge: Rs.
        <?php
            $ccharge=rand(10, 50);
            echo($ccharge);
            $_SESSION['pmoney']=$ccharge;
            //$query="INSERT INTO `cancelledrides`('$_SESSION['rid']', $_SESSION['cid']"
        ?>
        <input type="text" name="reason" id="reason" placeholder="Please enter the reason for cancellation!!">
        <input type="submit" value="by customer" name="bc">
        <input type="submit" value="by driver" name="bd">
        <?php
            if(isset($_POST['bc']) || isset($_POST['bd'])){
                $rid=$_SESSION['rid'];
                $reason=$_POST['reason'];
                $_SESSION['reason'] = $reason;
                $cid=$_SESSION['cid'];
                if(isset($_POST['bc'])){
                    $query="INSERT INTO `cancelledrides` (`rid`, `cid`, `reason`, `fine`, `byCustomer`) VALUES ('$rid', '$cid', '$reason', '$ccharge', '1')";
                }else{
                    $query="INSERT INTO `cancelledrides` (`rid`, `cid`, `reason`, `fine`, `byCustomer`) VALUES ('$rid', '$cid', '$reason', '$ccharge', '0')";
                }
                $result=mysqli_query($conn, $query);
                $query="UPDATE `ride` SET `status` = '3' WHERE `ride`.`rid` = '$rid' ";
                $result=mysqli_query($conn, $query);
        ?>        

        <?php 

            if(isset($_GET['error'])) { ?>
                <p class="error"> <?php echo $_GET['error']; ?></p>
            <?php } ?>
        </p>
        <a href="payment.php" class="btn btn-primary">Pay Now</a>
        <a href="feedback.php" class="btn btn-primary">Pay Later</a>
        <?php
            }
        ?>

    </form>
</body>
</html>
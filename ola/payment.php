<!DOCTYPE html>
<html>
<head>
    <title> LOGIN </title>
    <link rel="stylesheet" href="styleP.css">
    <?php
        include "db_conn.php";
        include "links.php";
        session_start();
    ?>
</head>
<body>
    <form action="" method="post">
        <h2>PAYMENT</h2>
        <p> Pay amount: Rs.<?php
            echo (float)$_SESSION['pmoney'];
        ?>
        <?php if(isset($_GET['error'])) { ?>
            <p class="error"> <?php echo $_GET['error']; ?></p>
        <?php } ?>
     </p>
        <label for="mode">Choose payment mode:</label>
        <select name="mode" id="mode">
        <option value="UPI">UPI</option>
        <option value="Wallet">Wallet</option>
        <option value="Net Banking">Net Banking</option>
        <option value="Cash">Cash</option>
        </select>
        <input type="submit" name="pay" value="Pay"/>
    </form>
    <?php
        if(isset($_POST['pay'])){
            $pType = $_POST['mode'];
            $tipAmount=$_SESSION['tipAmount'];
            $totalAmount=$_SESSION['pmoney'];
            $transId=rand(5, 50);
            $_SESSION['transId']=$transId;
            $query="INSERT INTO `payments` (`mode`, `tipAmount`, `totalAmount`, `transactionID`) VALUES ('$pType', '$tipAmount', '$totalAmount', '$transId')";
            $result=mysqli_query($conn, $query);
            $query="select count(*) as cnt from payments";
            $result=mysqli_query($conn, $query);
            $row=mysqli_fetch_array($result);
            $pid=$row['cnt'];
            $rid=$_SESSION['rid'];
            $query="UPDATE `ride` SET `pid` = '$pid' WHERE `ride`.`rid` = '$rid'";
            $result=mysqli_query($conn, $query);
            header("Location:thanks.php");
        }
    ?>
</body>
</html>
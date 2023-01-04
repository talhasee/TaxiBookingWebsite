<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
        include "db_conn.php";
        include "links.php";
        session_start();
    ?>
</head>
<body>
<h3 class="display-3     text-left text-muted my-1"><?php echo "Ride has been done!";
            echo "<br>";
            echo "Your billing Information";
            $rid=$_SESSION['rid'];
            $query="UPDATE `ride` SET `status` = '1' WHERE `ride`.`rid` = '$rid' ";
            $result=mysqli_query($conn, $query);
            $query="UPDATE `ride` SET `endTime` = NOW() WHERE `ride`.`rid` = '$rid' ";
            $result=mysqli_query($conn, $query);
            
        ?> </h3>
<div class="card" style="width: 18rem;">
  <ul class="list-group list-group-flush">
    <li class="list-group-item"><?php  echo "Present Amount: ". $_SESSION['pmoney']; ?></li>
    <li class="list-group-item">
        <?php
            $cid=$_SESSION['cid'];
            $query="select ramount from customer where cid='$cid'";
            $result=mysqli_query($conn, $query);
            $row=mysqli_fetch_array($result);
            echo "Remaining Amount(this is the cancellation fee which has not been paid): ".$row['ramount'];
        ?>
    </li>
    <li class="list-group-item">
        <?php  
            $tipAmount = rand(50, 60)/10;
            $_SESSION['tipAmount'] = $tipAmount;
            echo "Tip Amount: ". $tipAmount;
        ?>
    </li>
    <li class="list-group-item">
        <?php  
            $_SESSION['finalPresentAmount'] = $_SESSION['pmoney'] - $tipAmount;
            echo "Final Present Amount(After having tip amount): ". $_SESSION['finalPresentAmount'];
        ?>
    </li>
    <li class="list-group-item">
        <?php  
            $_SESSION['totalAmount'] = (float)$_SESSION['pmoney'] + (float)$row['ramount'] - $tipAmount;
            echo "Total Amount: ". $_SESSION['totalAmount'];    
        
        ?>
    </li>
    <form action="" method="post">
        <input type="submit" name="pta" value="Pay Total Amount"/>
        <input type="submit" name="ppa" value="Pay Present Total Amount"/>
    </form>
    <?php
        if(isset($_POST['pta']) || isset($_POST['ppa'])){
            if(isset($_POST['pta'])){
                //$_SESSION['totalAmount'] = $_SESSION['finalpAmount'] +  $row['ramount'];
                $_SESSION['pmoney'] = $_SESSION['totalAmount'];
            }else{
                $_SESSION['pmoney'] = $_SESSION['finalPresentAmount'];
            }
            header("Location:payment.php");
        }
    ?>
  </ul>
</div>
</body>
</html>
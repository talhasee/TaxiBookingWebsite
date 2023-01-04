<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Driver Homepage</title>
    <?php
        include "db_conn.php";
        include "links.php";
        session_start();
        
        //ASSUMED THE DRIVER TO BE AS 1
        $did=$_SESSION['did'];
        ////////////////////

        // $working=0;
    
        $query="select workingStatus, did, dlicenseNo as dlno, rating, phoneNum as pn, currentStatus, CONCAT(firstName, ' ', lastName) as dname from driver where did='$did'";
        $result=mysqli_query($conn, $query);
        $row=mysqli_fetch_array($result);
        $working=$row['workingStatus'];
        $currentStatus=$row['currentStatus'];
        $did=$row['did'];
        $rating=$row['rating'];
    ?>
</head>
<body>
<h3 class="display-3     text-left text-muted my-1"><?php echo "Hello, " . $row['dname']; ?> </h3>
    <form action="homeD.php" method="post">
    <?php
        if($working==1){

            ?>
            <span class="badge rounded-pill bg-danger">Not Working</span>
            <?php
        }else{
            ?>
            <span class="badge rounded-pill bg-success">Working</span>
        <?php
            if($currentStatus==1){
                ?>
                <span class="badge rounded-pill bg-info text-dark">Availaible</span>
                <?php
            }else{
                ?>
                <span class="badge rounded-pill bg-info text-dark">Not Availaible</span>
                <?php
            }
        }
        ?>
        <input type="submit" name="sub" value="change status of working">

        <?php
            if(isset($_POST['sub'])){
                $working= 1-$working;
                $query="UPDATE `driver` SET `workingStatus` = '$working' WHERE `did` = '$did' ";
                $result=mysqli_query($conn, $query);
            }
        ?>

<div class="card mb-2" style="max-width: 740px;">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="img/tdriver.jpg" class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <!-- <h5 class="card-title">h5> -->
                    <p class="card-text">
                        <?php
                            echo "Driver Id:" . $row['did'];
                            echo "<br>";
                            echo "<br>";
                            echo "Driver License No:" . $row['dlno'];
                            echo "<br>";
                            echo "<br>";
                            echo "phone Number:" . $row['pn'];
                            echo "<br>";
                            echo "<br>";
                            echo "rating:" . $row['rating'];
                        ?>
                    </p>   
                </div>
            </div>
        </div>
    </div>
    </div>
<!-- 
    <div class="hstack gap-3">
  <input class="form-control me-auto" type="text" placeholder=";   ?>" aria-label="Add your item here...">
  <input type="submit" value="calculate" name="calc">
  <div class="vr"></div> -->
  <input type="submit" value="calculate total Working Hours for this year" name="calc1">
  <?php
        if(isset($_POST['calc1'])){
            $did=$_SESSION['did'];
            $query="DROP VIEW IF EXISTS cal_tot_wrk_hrs";
            $result=mysqli_query($conn, $query);
            $query="CREATE view cal_tot_wrk_hrs as SELECT did, entryTime et1, exitTime ex1, entryTime et2, dateOfSlot FROM DriverSlots where did='$did'";
            $result=mysqli_query($conn, $query);
            $query="UPDATE cal_tot_wrk_hrs set et1 = ex1 AND ex1 = et2 WHERE et1>ex1";
            $result=mysqli_query($conn, $query);
            $query="SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(Temp.interval_of_time))) as tot_wrk_hr from (SELECT TIMEDIFF(ex1, et2) as interval_of_time FROM cal_tot_wrk_hrs WHERE dateOfSlot LIKE '2022%') Temp"; 
            $result=mysqli_query($conn, $query);
            $row=mysqli_fetch_array($result); 
            ?>
            <h3> <?php echo "Total total working hours for this year: ". $row['tot_wrk_hr']; ?> </h3>
            <?php
        }
        echo "<br>";
        echo "<br>";
        echo "<br>";
  ?>
    <input type="submit" value="calculate the Earnings earned from this organization" name="calc2">
    <?php
        if(isset($_POST['calc2'])){
            $query="select SUM(totalAmount) as sum from ride natural join payments where did='$did';";
            $result=mysqli_query($conn, $query);
            $row=mysqli_fetch_array($result);
            ?>
            <h3> <?php echo "Total working hours for this year: ". $row['sum']; ?> </h3>
            <?php
        }
        echo "<br>";
        echo "<br>";
        echo "<br>";
  ?>
      <input type="submit" value="calculate the most ride prone area" name="calc3">
    <?php
        if(isset($_POST['calc3'])){
            $query="create view ridesBydriver as select * from ride natural join customersrcdest where did=4;";
            $result=mysqli_query($conn, $query);
            $query="update ridesbydriver set srcBlock='j', srcCity='Springfield', srcState='California';";
            $result=mysqli_query($conn, $query);
            $query="select count(*) as nor, CONCAT(srcBlock, '/', srcCity, '/', srcState) as source from ridesbydriver";
            $result=mysqli_query($conn, $query);
            $row=mysqli_fetch_array($result);
            ?>
            <h3> <?php echo  $row['nor']." rides are booked from the place: ".$row['source']; ?> </h3>
            <?php
        }
        echo "<br>";
        echo "<br>";
        echo "<br>";
  ?>
  <a href="logout.php" class="btn btn-primary">logout</a>
</form>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <?php 
    include "links.php"; 
    include "db_conn.php"
    ?>
</head>
<body>
    <h3 class="display-3     text-left text-muted my-1"><?php echo "Associated Driver With Car"?> </h3>
    <?php
        session_start();
        //$did=1;

        // AGAIN ASSUMED THE DID TO BE 1

        //$_SESSION['did'] = 1;
        $carId=$_SESSION['carId'];
        $query="select did from car where carId='$carId'";
        $result=mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);
        $_SESSION['did'] = $row['did'];
        $did=$row['did'];
        $query = "select d.did, CONCAT(d.firstName, ' ', d.lastName)  as dname, d.phoneNum as pn, d.dlicenseNo as dlno, d.rating from driver d where did=$did";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);
        $_SESSION['dpn'] = $row['pn'];
        $_SESSION['dname'] = $row['dname'];
    ?>
    <div class="card mb-2" style="max-width: 740px;">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="img/tdriver.jpg" class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $row['dname'] ?></h5>
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
                    <a href="confirmation.php" class="btn btn-primary">Book</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
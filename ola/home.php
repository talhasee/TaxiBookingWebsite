<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Journey Planning </title>
    <link rel="stylesheet" href="indexStyle.css">
    <?php include "links.php"; ?>
</head>
<body>
    <form action="" method="post">
        <h2>Plan Your Destination</h2>
        <label> Enter your Current Location</label>
        <input type="text" name="src" placeholder="block/city/state"><br>
        <label>Enter your Destination</label>
        <input type="test" name="dest" placeholder="block/city/state"><br>
        <input type="submit" name="Proceed" value="Search"/>
    </form>
    
    <?php
        $flag = false;
        session_start();
        include "db_conn.php";

        if(isset($_POST['src']) && isset($_POST['dest'])){
            $src = $_POST['src'];
            $dest = $_POST['dest'];
            if(empty($src)){
                header("Location: home.php?error=Source is required to search for the cabs!");
                exit();
            }else if(empty($dest)){
                header("Location: home.php?error=Destination is required is required to search for the cabs!");
                exit();
            }else{
                $flag = true;
                $_SESSION['src'] = $src;
                $_SESSION['dest']  = $dest;
                $src =  str_replace('/', '', $src);
                $dest = str_replace('/', '', $dest);
                $query = "select c.carId, c.carName as name, d.did, c.chargePerKm as charge, cc.catname as cat from locationstatus ls, driver d, car c, carcategories cc where ls.did=d.did and CONCAT(ls.block, ls.city, ls.state) LIKE '$src' and c.catId=cc.catId and c.did= d.did;";
                //removed the part of the 
                //$query = "select * from driver where did<2";
                $result = mysqli_query($conn, $query);
                $num = mysqli_num_rows($result);

                ///  ASSUMED THE CUSTOMER ID=1
                //$_SESSION['cid'] = 1;     // will be decided based on the input


            }
        }
    ?>

    <?php
        if($flag==true){          
            ?>

            <?php
                if($num>0){
                    $dist = rand(2, 70);
                    ?>
                        <h2 class="display-3 text-center text-muted my-4"><?php echo "Your approximated Travel Distance is(in Km):" . $dist; ?> </h2>
                        <h1 class="display-3 text-center text-muted my-4">Cars Availaible For Your Journey</h1>
                    <?php
                    while ($row=mysqli_fetch_array($result)) {
                        ?>
                        <div class="row">
                            
                            <div class="col-md-6 col-lg-4">
                                <div class="card-mb-3">
                                    <?php
                                        if($row['cat']=='Suv'){
                                            ?>
                                            <img src="img/Suv.jpg" alt="" class="card-img-top">
                                            <?php
                                        }else if($row['cat']=='Van'){
                                            ?>
                                            <img src="img/Van.jpg" alt="" class="card-img-top">
                                            <?php
                                        }else{
                                            ?>
                                            <img src="img/Sedan.jpg" alt="" class="card-img-top">
                                            <?php
                                        }
                                    ?>
                                    <div class="card-body">
                                        <h4 class="card-title"> <?php echo $row['name'] . "(" . $row['cat'] .")"; ?> </h4>
                                        <?php 
                                            $_SESSION['carname']=$row['name']; 
                                            $_SESSION['carId'] =$row['carId'];
                                            $_SESSION['chargePerKm'] = $row['charge'];
                                            $_SESSION['pmoney'] = $row['charge']*$dist
                                        ?>
                                        <p class="card-text">
                                            <?php
                                                echo "Charge Per Km:" . $row['charge'];
                                                echo "<br>";
                                                echo "Total Charge:" . $row['charge']*$dist
                                            ?>
                                        </p>
                                        <a href="driverDetails.php" class="btn btn-primary">Select</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                    <?php        
                    }
                }else{
                    ?>
                    <h1 class="display-3 text-center text-muted my-4">No Cars Availaible For Your Journey yet you could try again!!</h1>
                    <?php
                    session_destroy();
                }
                    ?>

        <?php
        }
        ?>
<a href="logout.php" class="btn btn-primary">logout</a>
</body>
</html>


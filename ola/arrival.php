<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arrival Of Driver</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <img class="bg" src="bgCounter.jpg" alt="Timer" >
    <p id="demo"></p>
    <?php
        function OpenRidingTimer(){
            header("Location: RidingTimer.php");
        }
        function WaitForSec($sec){
            $i = 1;
            $last_time = $_SERVER['REQUEST_TIME'];
            while($i > 0){
                $total = $_SERVER['REQUEST_TIME'] - $last_time;
                if($total >= 2){
                    return 1;
                    $i = -1;
                }
            }
        }
    ?>
    <form>
        <script type = "text/javascript">
            function countDown(secs,elem) {
                var element = document.getElementById(elem);
                element.innerHTML = "Driver Arriving In "+secs+"       seconds";

                if(secs < 1) {
                    clearTimeout(timer);
                    element.innerHTML = '<h2>Driver has Arrived!!!! </h2>';
                    element.innerHTML = '<a href="rideDone.php">Start The Ride</a>';
                    return 0;
                }
                secs--;
                var timer = setTimeout('countDown('+secs+',"'+elem+'")',1000);
                
            }
            </script>

            <div class = "container" id="status"style="font-size:40px;,
            text-align: center"></div>
            
            <script>
                countDown(5,"status"); 
            </script> 
        </script>
                <a href="cancel.php" class="button">Cancel Ride</a>
        </form>
</body>
</html>






<?php
include 'setting.php';
include('../config/constrants.php'); 



?>
<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online food order</title>
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>
<body>
    

    <div class="card" style="width:400px">
    <img src="download.jpg" alt="ims" class="card-img-top">
    <div class="card-body">
    <div class="card-title">
    Purchase with esewa
    </div>
    <div class="card-text">You can use this software for your payment for food order. </div>
    <form action=<?php echo $epay_url?> method="POST">
    <input value="1000" name="tAmt" type="hidden">
    
    <!-- <input value="$<?php echo $total; ?>" name="tAmt" type="hidden"> -->
    <input value="900" name="amt" type="hidden">
    <input value="50" name="txAmt" type="hidden">
    <input value="20" name="psc" type="hidden">
    <input value="30" name="pdc" type="hidden">
    <input value=<?php echo $merchant_code?>  name="scd" type="hidden">
    <input value="<?php echo $pid?>" name="pid" type="hidden">
    <input value=<?php echo $successurl?> type="hidden" name="su">
    <input value=<?php echo $failedurl?> type="hidden" name="fu">
    <input value="Pay with Esewa " type="submit" class="btn btn-primary">
    </form>
    </div>
    </div>



    <!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>
<?php
                    //create sql query to get total revenue generated
                    //aggregate function in sql
                    $sql4 = "SELECT * FROM tbl_order ";

                    //execute the query
                    $res4 = mysqli_query($conn, $sql4);

                    //get the value
                    $row4 = mysqli_fetch_assoc($res4);

                    //get the total revenue
                    $total = $row4['total'];
                ?>                
                    <!-- <h1>$<?php echo $total; ?></h1> -->
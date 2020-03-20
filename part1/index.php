<?php
session_start();
require('./vending.php');

// echo 1.25 - 1.25 ;

if(isset($_POST['continue'])) {
    session_destroy();
    header('Location: index.php');
}

$choice = null;
if(empty($_SESSION['choice'])) {
    $choice = new products();
} else {
    $choice = unserialize($_SESSION['choice']);
}

if(isset($_POST['product'])) {
    $choice->choiceMade($_POST['product']);
   $_SESSION['choice'] = serialize($choice); 
}

if(isset($_POST['coin'])) {
    // echo "get amount :". $choice->GetAmount()."<br>";
    //  echo "coin selected ".$_POST['coin'];
  $coins = $choice->GetAmount() + $_POST['coin'];
    $choice->SetAmount($coins);
   $_SESSION['choice'] = serialize($choice);
   // print_r($_SESSION['choice']);
}

?>
<html>
<head>
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="col-md-6 col-md-offset-3">
            <h1>Vending Machine</h1>
       
    <form method="post" class="form-inline">
        <?php if(empty($_SESSION['choice'])) { ?>
            <h2>Choose Products To Continue:</h2>
            <input type="submit" name="product" value="Chocolate" class="form-control">
            <input type="submit" name="product" value="Pop" class="form-control">
            <input type="submit" name="product" value="Chips" class="form-control">
        <?php } else {
             $amount = (float) $choice->GetAmount();
             $price = (float) $choice->GetPrice();
        //     echo "numeric check". is_float($price)."hello ";
        // echo 1.05+0.05+0.10+0.05;
            if($amount == $price) {

                echo '<h2>Thank You.</h2>';
                
                echo '<input type="submit" name="continue" value="Continue">';
            }
            elseif ( $amount > $price) {
                    $diff = $choice->GetAmount() - $choice->GetPrice();
                    if($diff == 2.2204460492503E-16)
                    {

                    }else
                    {
                        echo '<h3>Your Change is : &#162;'. $diff . ' . Please collect.</h3>';
                echo '<input type="submit" name="continue" value="Continue" class="btn btn-success">';
                    }
                    
            }
             else {
            ?>
            <h2>Enter coins</h2>
            <button type="submit" name="coin" value="100" class="btn btn-primary">$1</button>
            <button type="submit" name="coin" value="5" class="btn btn-info">5¢</button>
            <button type="submit" name="coin" value="10" class="btn btn-danger">10¢</button>
            <button type="submit" name="coin" value="25" class="btn btn-warning">25¢</button>
            <?php 
            // For price print
                if($choice->GetPrice() == 125)
                {
                    $pricePrint = "1.25";
                }
                if($choice->GetPrice() == 150)
                {
                    $pricePrint = "1.50";
                }
                if($choice->GetPrice() == 175)
                {
                    $pricePrint = "1.75";
                }
            ?>
            <h4><?php echo $choice->GetProduct() . " Price: $" . $pricePrint ?></h4>
            <h4><?php echo 'Your amount is: &#162;' . $choice->GetAmount(); ?></h4>
        <?php } } ?>
    </form>
     </div>
    </div>
</body>
</html>

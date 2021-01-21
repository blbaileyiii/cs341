<?php session_start();?>

<?php require './snippets/items.php'; ?>

<?php
unset($_SESSION["cart"]);
$_SESSION["count"] = 0;

// Validate...
$fname = htmlspecialchars($_POST["fname"]);
$lname = htmlspecialchars($_POST["lname"]);
$address = htmlspecialchars($_POST["address"]);
$city = htmlspecialchars($_POST["city"]);
$state = htmlspecialchars($_POST["state"]);
$zip = htmlspecialchars($_POST["zip"]);

$subtotal = htmlspecialchars($_SESSION["subtotal"]);
$shipping = htmlspecialchars($_SESSION["shipping"]);
$taxes = htmlspecialchars($_SESSION["taxes"]);
$total = htmlspecialchars($_SESSION["total"]);

$cart = array();

foreach($_POST["cart"] as $cart_item_id=>$cart_item_qty) {
    $cart[htmlspecialchars($cart_item_id)] = htmlspecialchars($cart_item_qty);
}

?>

<!DOCTYPE html>
<html lang="en-us">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CSE341 - Week 03: Bernard Bailey</title>
    <meta name="CSE341"
        content="Weel 03">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>    
    <?php require './snippets/top.php'; ?>
    <main>
        <div class="cart">
            <h1>Order Details</h1>
            <section>
                <h2>Order Summary</h2>
                <?php $currDate = new DateTime('NOW'); ?>
                <p>Ordered on <?php echo $currDate->format("l, F j, Y"); ?></p>
                <p>Order#: <?php echo $currDate->format("Yz-His-u"); ?></p>
                <p>Total: $<?php echo number_format($total, 2) ?></p>
            </section>            
            <section>
                <h2>Shipping Address</h2>
                <p><?php echo "{$fname} {$lname}" ?></p>
                <p><?php echo "{$address}" ?></p>
                <p><?php echo "{$city}, {$state} {$zip}" ?></p>
            </section>
            <section>
                <h2>Item Details</h2>            
                <?php foreach($cart as $cart_item_id=>$cart_item_qty){
                    if(array_key_exists($cart_item_id, $items)) {
                    ?>
                        <div class="cart item">
                            <a href="details.php?id=<?php echo "{$cart_item_id}";?>">
                                <div class="img-cont">
                                    <img src="./images/<?php echo "{$items[$cart_item_id][2]}";?>" alt="img <?php echo "{$items[$cart_item_id][0]}";?>" >
                                </div>
                            </a>
                            <div class="cart-item-det">
                                <div>
                                    <a href="details.php?id=<?php echo "{$cart_item_id}";?>">
                                        <?php echo $items[$cart_item_id][0] ?>
                                    </a>                            
                                    <div class="item ext-det">
                                        <span>Quantity: <?php echo $cart_item_qty?></span>
                                    </div>
                                </div>
                                <span class="price">Price: $<?php echo number_format($cart_item_qty * $items[$cart_item_id][4], 2) ?></span>
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>
            </section>
            <div class="price summary">                
                <ul>
                    <li><span>SubTotal:</span><span>$<?php echo number_format($subtotal, 2) ?></span></li>
                    <li><span>Shipping:</span><span>$<?php echo number_format($shipping, 2) ?></span></li>
                    <li><span>Taxes:</span><span>$<?php echo number_format($taxes, 2) ?></span></li>
                    <li class="total"><span>Total:</span><span>$<?php echo number_format($total, 2) ?></span></li>
                </ul>
            </div>
        </div>
    </main>
    <?php require './snippets/footer.php'; ?>
</body>
</html>
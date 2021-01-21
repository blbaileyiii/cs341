<?php session_start();?>

<?php require '../snippets/items.php'; ?>

<?php
if ( isset($_SESSION["cart"]) ) {
    if (count($_SESSION["cart"]) == 0 ){
        unset($_SESSION["cart"]);
    }
}

// Reset
if ( isset($_GET['reset']) ) {
if ($_GET["reset"] == 'true') {
    unset($_SESSION["cart"]);
    unset($_SESSION["count"]);
    unset($_SESSION["subtotal"]);
    unset($_SESSION["shipping"]);
    unset($_SESSION["taxes"]);
    unset($_SESSION["total"]);
}
}

// Reduce from Cart
if ( isset($_GET["remove"]) ) {
    $item = $_GET["remove"];
    $qty = $_SESSION["cart"][$item]["qty"];
    $qty--;
    $_SESSION["cart"][$item]["qty"] = $qty;

    if ($qty <= 0) {
        unset($_SESSION["cart"][$item]);
    }

    if (count($_SESSION["cart"]) == 0 ){
        unset($_SESSION["cart"]);
    }
}

// Delete from Cart
if ( isset($_GET["delete"]) ) {
    $item = $_GET["delete"];
    unset($_SESSION["cart"][$item]);

    if (count($_SESSION["cart"]) == 0 ){
        unset($_SESSION["cart"]);
    }
}

$_SESSION["count"] = 0;
if ( isset($_SESSION["cart"]) ) {

    // Count Items
    $_SESSION["count"] = 0;
    foreach($_SESSION["cart"] as $item_id=>$item_qty){
            $_SESSION["count"] += $item_qty["qty"];
    }

    // Subtotal
    $subtotal = 0;
    foreach($_SESSION["cart"] as $cart_item_id=>$cart_item){
        $subtotal += $cart_item["qty"] * $items[$cart_item_id][4];
    }
    $_SESSION["subtotal"] = $subtotal;


    // Shipping
    $_SESSION["shipping"] = 0;
    
    // Taxes
    $tax_rate = 0.0725;
    $_SESSION["taxes"] = ($_SESSION["subtotal"] + $_SESSION["shipping"]) * $tax_rate;

    // Total
    $_SESSION["total"] = $_SESSION["subtotal"] + $_SESSION["shipping"] + $_SESSION["taxes"];
}
?>

<!DOCTYPE html>
<html lang="en-us">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CSE341 - Profile: Bernard Bailey</title>
    <meta name="CSE341"
        content="My Profile">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>    
    <?php require './snippets/top.php'; ?>
    <main>        
        <div class="cart">
            <?php if ( isset($_SESSION["cart"]) ) { ?>  
                <h1>My Cart</h1>
                <?php foreach($_SESSION["cart"] as $cart_item_id=>$cart_item){ 
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
                                    <span>Quantity: <?php echo $cart_item["qty"] ?></span>
                                    <a class="style-button" href="?remove=<?php echo($cart_item_id); ?>">Remove 1</a>
                                    <a class="style-button" href="?delete=<?php echo($cart_item_id); ?>">Delete All</a>
                                </div>
                            </div>
                            <span class="price">Price: $<?php echo number_format($cart_item["qty"] * $items[$cart_item_id][4], 2) ?></span>
                        </div>
                    </div>
                <?php }} ?>                
                <div class="price summary">
                    <ul>
                        <li><span>SubTotal:</span><span>$<?php echo number_format($_SESSION["subtotal"], 2) ?></span></li>
                        <li><span>Shipping:</span><span>$<?php echo number_format($_SESSION["shipping"], 2) ?></span></li>
                        <li><span>Taxes:</span><span>$<?php echo number_format($_SESSION["taxes"], 2) ?></span></li>
                        <li class="total"><span>Total:</span><span>$<?php echo number_format($_SESSION["total"], 2) ?></span></li>
                        <li><span> </span><a class="style-button" href="checkout.php">Checkout</a></li>
                    </ul>
                </div>
                <a href="?reset=true">Reset Cart</a>
            <?php } else { ?>
                <h1>Your Shopping Cart is empty.</h1>
                <a href="index.php" title="Shopping">Continue Shopping</a>
            <?php } ?>
        </div>
    </main>
    <?php require './snippets/footer.php'; ?>
</body>
</html>
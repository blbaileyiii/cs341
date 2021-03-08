<?php session_start();?>

<?php require './snippets/items.php'; ?>

<!DOCTYPE html>
<html lang="en-us">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CSE341 - Week 03: Bernard Bailey</title>
    <meta name="CSE341"
        content="Week 03">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>    
    <?php require './snippets/top.php'; ?>
    <main>
        <div class="cart">
            <?php if ( isset($_SESSION["cart"]) ) { ?>  
                <h1>Checkout</h1>
                <section class="shipping">
                    <h2>Shipping Address</h2>
                    <form action="confirmation.php" method="post" autocomplete="on">
                        <label for="fname">First Name</label>
                        <input id="fname" name="fname" type="text" autocomplete="given-name" placeholder="First Name" required>
                        <label for="lname">Last Name</label>
                        <input id="lname" name="lname" type="text" autocomplete="family-name" placeholder="Last Name" required>
                        <label for="address">Street Address</label>
                        <input id="address" name="address" type="text" autocomplete="street-address" placeholder="Street Address" required>
                        <label for="city">City</label>
                        <input id="city" name="city" type="text" autocomplete="address-level2" placeholder="City" required>
                        <label for="state">State</label>
                        <input id="state" name="state" type="text" autocomplete="address-level1" placeholder="State" required>
                        <label for="zip">Zip</label>
                        <input id="zip" name="zip" type="text" autocomplete="postal-code" placeholder="Zip" required>
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
                                    <input name="cart[<?php echo $cart_item_id; ?>]" type="hidden" value="<?php echo $cart_item["qty"]; ?>">
                                </div>
                            </div>
                        <?php }} ?>                
                        <div class="price summary">
                            <ul>
                                <li><span>SubTotal:</span><span>$<?php echo number_format($_SESSION["subtotal"], 2) ?></span></li>
                                <li><span>Shipping:</span><span>$<?php echo number_format($_SESSION["shipping"], 2) ?></span></li>
                                <li><span>Taxes:</span><span>$<?php echo number_format($_SESSION["taxes"], 2) ?></span></li>
                                <li class="total"><span>Total:</span><span>$<?php echo number_format($_SESSION["total"], 2) ?></span></li>
                                <li><span> </span><button class="style-button" type="submit">Place Your Order</button></li>
                            </ul>
                        </div>
                        <a href="?reset=true">Reset Cart</a>
                    </form>
                </section>
            <?php } ?>            
        </div>
    </main>
    <?php require './snippets/footer.php'; ?>
</body>
</html>
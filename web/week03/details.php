<?php session_start();?>

<?php require './snippets/items.php'; ?>

<?php
if ( isset($_SESSION["cart"]) ) {
    if (count($_SESSION["cart"]) == 0 ){
        unset($_SESSION["cart"]);
    }
}

// Add to Cart
if ( isset($_GET["add"])) {
    if ( !isset($_SESSION["cart"]) ) {
        //$_SESSION["cart"]["ID"] = array(qty=>x);
        $_SESSION["cart"] = array();    
    }

    $item = htmlspecialchars($_GET["add"]);
    $item_qty  = htmlspecialchars($_GET["qty"]);

    if( isset($_SESSION["cart"][$item])){
        $qty = $_SESSION["cart"][$item]["qty"] + $item_qty;
    } else {
        $qty = $item_qty;
    }
    
    if($qty <= $items[$item][3]) {
        $_SESSION["cart"][$item] = array("qty"=>$qty);        
    }
}

if ( isset($_GET["id"]) ) {
    $id = htmlspecialchars($_GET["id"]);
}


$_SESSION["count"] = 0;
if ( isset($_SESSION["cart"]) ) {
    foreach($_SESSION["cart"] as $item_id=>$item_qty){
        $_SESSION["count"] += $item_qty["qty"];
    }
}

?>

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
        <div class="details">
            <div class='stock item'>
                <div class="details-img-cont">
                <img src="./images/<?php echo "{$items[$id][2]}";?>" alt="img <?php echo "{$items[$id][0]}";?>" >
                </div>
                <div class='stock-item-det'>
                    <div><?php echo "{$items[$id][0]}";?></div>
                    <div>Description: <?php echo "{$items[$id][1]}"; ?></div>
                    <form class="price-stock" action="details.php" method="get">
                        <span class="price">
                            <?php $price = explode(".", $items[$id][4]); ?>
                            <span class="price-sign">$</span><span class="price-dollar"><?php echo "{$price[0]}";?></span><span class="price-cents"><?php echo "{$price[1]}";?></span>
                        </span>
                        <span class="stock-ind">
                            <?php 
                            if($items[$id][3] > 3){
                                echo "IN STOCK";
                            } elseif ($items[$id][3] > 0) {
                                echo "LOW STOCK";
                            } else {
                                echo "OUT OF STOCK";
                            } ?>
                        </span>
                        <input id="id" name="id" type="hidden" value="<?php echo "{$id}";?>">
                        <input id="qty" name="qty" type="number" value="1" min="0" max="<?php echo "{$items[$id][3]}" ?>">
                        <button class="style-button" id="add" name="add" value="<?php echo "{$id}";?>" type="submit">Add to Cart</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <?php require './snippets/footer.php'; ?>
</body>
</html>
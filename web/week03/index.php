<?php session_start();?>

<?php require '../snippets/items.php'; ?>

<?php
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
        content="Weel 03">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php require './snippets/top.php'; ?>
    <main>
        <div class="stock">
            <?php
                foreach($items as $item_id=>$item){
                $price = explode(".", $item[4]);
            ?>
                <div class='stock item'>
                    <a href="details.php?id=<?php echo "{$item_id}";?>">
                        <div class="img-cont">
                            <img src="./images/<?php echo "{$item[2]}";?>" alt="img <?php echo "{$item[0]}";?>" >
                        </div>
                        <?php echo "{$item[0]}";?>
                    </a>
                    <div class="price-stock">
                        <div class="price">
                            <span class="price-sign">$</span><span class="price-dollar"><?php echo "{$price[0]}";?></span><span class="price-cents"><?php echo "{$price[1]}";?></span>
                        </div>
                        <div class="stock-ind">
                            <?php 
                            if($item[3] > 3){
                                echo "IN STOCK";
                            } elseif ($item[3] > 0) {
                                echo "LOW STOCK";
                            } else {
                                echo "OUT OF STOCK";
                            } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </main>
    <?php require './snippets/footer.php'; ?>
</body>
</html>
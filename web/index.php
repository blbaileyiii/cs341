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
    <div class="console">            
        <div class="border right"></div>            
        <div class="border left"></div>
        <div class="border top"></div>
        <div class="border bottom"></div>            
        <div class="content">
            <?php require 'snippets/nav.php'; ?>
            <main>           
                <h1>Student Profile</h1>
                <div class="flex">
                    <div>
                        <h2>Name: Bernard L. Bailey III</h2>
                        <ul class="content-ul">
                            <li><span class="category">Major:</span> Applied Technology</li>                        
                            <?php
                            $datetime1 = new DateTime('NOW');
                            $datetime2 = new DateTime('1981-10-12');
                            $age = date_diff($datetime1, $datetime2);
                            echo '<li><span class="category">Age:</span> ' . $age->format("%y") . '</li>';
                            ?>
                            <li><span class="category">Height:</span> 6'2"</li>
                            <li><span class="category">Weight:</span> ERR</li>
                            <li><span class="category" onmouseover="toggleFam();" onmouseout="toggleFam();">Family:</span> Married, 1 Child(Male)</li>
                            <li><span class="category">Hobbies/Interests:</span> Board Games, Programming</li>
                            <li>
                                <span class="category">Favorites:</span>
                                <ul>
                                    <li><span class="category">Author:</span> Garth Nix, Dakota Krout</li>
                                    <li><span class="category">Board Game Company:</span> Certifiable Studios</li>
                                    <li><span class="category">Board Game:</span> Carcassonne, Stuffed, Secret Hitler, 
                                        <br>Code Names, D6, XYBRID, Quarriors, Love Letter</li>
                                    <li><span class="category">Food:</span> Pizza, Grilled Cheese, Burritos</li>
                                </ul>
                            </li>
                            <li><span class="category">Assignments:</span> <a href="a_blbaileyiii.php" title="Student Assignments - Bernard Bailey">a_blbaileyiii.php</a></li>
                        </ul>                        
                    </div>
                    <img id="imgswap" src="imgs/lee_prof_dec_2020.jpg" alt="Bernard L. Bailey III" onmouseover="toggleFam();" onmouseout="toggleFam();">
                </div>
                <div class="drive">Nav:<a href="a_blbaileyiii.php" title="Student Assignments - Bernard Bailey">Assignments</a></div>
            </main>
            <?php require 'snippets/nav.php'; ?>
            <?php require 'snippets/footer.php'; ?>
        </div>            
    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    const images = ["imgs/lee_prof_dec_2020.jpg", "imgs/christmas_2020.jpg"];
    function toggleFam(){        
        let img = document.getElementById("imgswap");
        let imgSrc = img.getAttribute("src")
        let position = images.indexOf(imgSrc);
        switch(position) {
            case 0:
                position = 1;
                break;
            case 1:
            default:
                position = 0;
        }

        img.src = images[position];
        
    }
</script>
</html>
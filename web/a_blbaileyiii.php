<!DOCTYPE html>
<html lang="en-us">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CSE341 - Assignments: Bernard Bailey</title>
    <meta name="CSE341"
        content="Student Assignments - Bernard Bailey">
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
                <h1>Student Assignments</h1>
                <div class="flex">
                    <div>
                        <h2>Name: Bernard L. Bailey III</h2>
                        <ul class="content-ul">
                            <li><span class="category">Course:</span> CSE341
                                <ul>
                                    <li><span class="category">Week01:</span>...</li>
                                    <li><span class="category">Week02:</span>...</li>
                                    <li><span class="category">Week03:</span>...</li>
                                </ul>
                            </li>
                        </ul>                        
                    </div>
                    <img id="imgswap" src="imgs/lee_prof_dec_2020.jpg" alt="Bernard L. Bailey III" onmouseover="toggleFam();" onmouseout="toggleFam();">
                </div>
                <div class="drive">Coming Soon</div>
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
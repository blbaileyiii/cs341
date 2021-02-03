<?php
	try
	{
		$dbUrl = getenv('DATABASE_URL');
		$dbOpts = parse_url($dbUrl);
	
		$dbHost = $dbOpts["host"];
		$dbPort = $dbOpts["port"];
		$dbUser = $dbOpts["user"];
		$dbPassword = $dbOpts["pass"];
		$dbName = ltrim($dbOpts["path"],'/');
		$db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch (PDOException $exc)
	{
		echo 'Error!: ' . $exc->getMessage();
		die();
    }
    
    $searchResultHTML = "";

    if(isset($_GET['book'])){
        $book = ucfirst($_GET['book']);
        $chapter = ucfirst($_GET['chapter']);
        $verse = ucfirst($_GET['verse']);
        if ($book != null)
        {
            
            foreach ($db->query("SELECT * FROM cse341ta05.scriptures WHERE book = '$book', chapter = '$chapter', verse = '$verse';") as $scripture)
            {
                $searchResultHTML .=  "<h2>$scripture[book] $scripture[chapter]:$scripture[verse]</h2>";
                $searchResultHTML .= "<p>$scripture[content]</a>";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en-us">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Echoes of Whimsy - Template</title>
    <meta name="Echoes of Whimsy"
        content="Echoes of Whimsy - Template">
        <link rel="stylesheet" href="/project/css/layout.css">
        <link rel="stylesheet" href="/project/css/typography.css">
        <link rel="stylesheet" href="/project/css/theme.css">
</head>

<body>
    <header>
        <?php include $currRoot . '/project/snippets/header.php'; ?>
    </header>
    <nav>
        <?php include $currRoot . '/project/snippets/nav.php'; ?>
    </nav>    
    <main>    
        <h1>Content Title Here</h1>
        <form action="index.php" method="get">
            <input type="text" name="book"/>
            <input type="submit" value="Submit"/>
        </form>

        <div>
            <?php echo $searchResultHTML;?>
        </div>
    </main>
    <footer>
    <?php include $currRoot . '/project/snippets/footer.php'; ?>
    </footer>
</body>
</html>







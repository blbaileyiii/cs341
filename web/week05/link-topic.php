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
	     
        $topics = "";

        foreach ($db->query("SELECT * FROM cse341ta05.topics ") as $topic)
        //foreach ($db->query("SELECT * FROM cse341ta05.scriptures WHERE book = '$book';") as $scripture)
        {
            $topics .= "<input type='checkbox' id='chk-$topic[id]' name='topics[chk-$topic[id]]'>";
            $topics .= "<label for='chk-$topic[id]'>$topic[name]</label>";
        }


    }
	catch (PDOException $exc)
	{
		echo 'Error!: ' . $exc->getMessage();
		die();
    }
?>



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
        <form method="post">
            <label for="book"></label>    
            <input type="text" id="book" name="book"/>
            <label for="chapter"></label>
            <input type="text" id="chapter" name="chapter"/>
            <label for="verse"></label>
            <input type="text" id="verse" name="verse"/>
            <label for="content"></label>
            <textarea id="content" name="content"></textarea>
            <?php echo $topics; ?>
            <input type="submit" value="Submit"/>
        </form>
    </main>
    <footer>
    <?php include $currRoot . '/project/snippets/footer.php'; ?>
    </footer>
</body>
</html>
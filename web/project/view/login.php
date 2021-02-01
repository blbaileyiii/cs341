<!DOCTYPE html>
<html lang="en-us">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Echoes of Whimsy - Login</title>
    <meta name="Echoes of Whimsy"
        content="Echoes of Whimsy - Login">
        <link rel="stylesheet" href="/project/css/layout.css">
        <link rel="stylesheet" href="/project/css/typography.css">
        <link rel="stylesheet" href="/project/css/theme.css">
</head>

<body>
    <header>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/project/snippets/header.php'; ?>
    </header>
    <nav>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/project/snippets/nav.php'; ?>
    </nav>    
    <main>
        <h1>Register</h1>
            <form action="#" method="post">
                <div>
                    <label for="email"><span>Email Address</span><span>Required</span></label>
                    <input id="email" name="email" type="email" autocomplete="email" required>
                    
                </div>
                <div>
                    <label for="password"><span>Password</span><span>Required</span></label>
                    <input id="password" name="password" type="password" autocomplete="current-password" required>
                    
                </div>
                <div>
                    <button type="submit">Login</button>
                </div>
                <div>
                    <div class="a-button">
                        <a href="?action=registration" title="Echoes of Whimsy - Register">Register</a>
                    </div>                    
                </div>
                
            </form>            
    </main>
    <footer>
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/project/snippets/footer.php'; ?>
    </footer>
</body>
</html>
<!DOCTYPE html>
<html lang="en-us">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Echoes of Whimsy - Login</title>
    <meta name="Echoes of Whimsy"
        content="Echoes of Whimsy - Login">
        <link rel="stylesheet" href="/project/css/theme.css">
        <link rel="stylesheet" href="/project/css/typography.css">
        <link rel="stylesheet" href="/project/css/layout.css">
</head>

<body>
    <header>
        <?php require $currRoot. '/project/snippets/header.php'; ?>
    </header>
    <?php require $currRoot. '/project/snippets/nav.php'; ?>  
    <main>
        <h1>Login</h1>
            <div class="message"><?php echo $message ?></div>
            <form class="form" method="post">
                <div class="fields">
                    <label for="uname"><span>User Name</span><span class="field-tip">Required</span></label>
                    <input id="uname" name="login[uname]" type="text" autocomplete="username" required>
                    
                </div>
                <div class="fields">
                    <label for="password"><span>Password</span><span class="field-tip">Required</span></label>
                    <input id="password" name="login[password]" type="password" autocomplete="current-password" required>                    
                </div>
                <div class="non-fields">
                    <button id="action" name="action" value="login" type="submit">Login</button>
                </div>
                <div class="non-fields">
                    <div class="button">
                        <a href="?action=registration" title="Echoes of Whimsy - Register">Register</a>
                    </div>                    
                </div>
                
            </form>            
    </main>
    <footer>
    <?php require $currRoot. '/project/snippets/footer.php'; ?>
    </footer>
</body>
</html>
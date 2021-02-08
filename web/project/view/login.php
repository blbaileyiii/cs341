<!DOCTYPE html>
<html lang="en-us">

<head>
    <?php $page = "Login" ?>
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/project/snippets/head.php'; ?>
</head>

<body>
    <header>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/project/snippets/header.php'; ?>
    </header>
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/project/snippets/nav.php'; ?>  
    <main>
        <h1><?php echo $page ?></h1>            
        <form class="form" method="post">
            <div class="message"><?php echo $message ?></div>
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
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/project/snippets/footer.php'; ?>
    </footer>
</body>
</html>
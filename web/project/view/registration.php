<!DOCTYPE html>
<html lang="en-us">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Echoes of Whimsy - Registration</title>
    <meta name="Echoes of Whimsy"
        content="Echoes of Whimsy - Registration">
        <link rel="stylesheet" href="/project/css/theme.css">
        <link rel="stylesheet" href="/project/css/typography.css">
        <link rel="stylesheet" href="/project/css/layout.css">
</head>

<body>
    <header>
        <?php require $currRoot . '/project/snippets/header.php'; ?>
    </header>
    <?php require $currRoot . '/project/snippets/nav.php'; ?>  
    <main>    
        <h1>Registration</h1>
        <form class="form" action="/project/index.php" method="post">
            <div class="message"><?php echo $message ?></div>
            <div class="fields">
                <label for="uname"><span>User Name</span><span class="field-tip">Required</span></label> 
                <input id="uname" name="register[uname]" type="text" autocomplete="username" required>
            </div>
            <div class="fields">
                <label for="email"><span>Email Address</span><span class="field-tip">Required</span></label>
                <input id="email" name="register[email]" type="email" autocomplete="email" required>
            </div>
            <div class="fields">
                <label for="password"><span>Password</span><span class="field-tip">Required</span></label>
                <input id="password" name="register[password]" type="password" autocomplete="new-password" required>
            </div>
            <div class="fields">
                <label for="fname"><span>First Name</span><span class="field-tip">Required</span></label> 
                <input id="fname" name="register[fname]" type="text" autocomplete="given-name" required>
            </div>
            <div class="fields">
                <label for="lname"><span>Last Name</span><span class="field-tip">Required</span></label>
                <input id="lname" name="register[lname]" type="text" autocomplete="family-name" required>
            </div>
            <div class="non-fields">
                <button id="action" name="action" value="register" type="submit">Register</button>
            </div>            
        </form>
    </main>
    <footer>
    <?php require $currRoot . '/project/snippets/footer.php'; ?>
    </footer>
</body>
</html>
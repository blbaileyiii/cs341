<!DOCTYPE html>
<html lang="en-us">

<head>
    <?php $page = "Registration" ?>
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/project/snippets/head.php'; ?>
</head>

<body>
    <header>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/project/snippets/header.php'; ?>
    </header>
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/project/snippets/nav.php'; ?>  
    <main>    
        <h1><?php echo $page ?></h1>
        <form class="form" action="/project/account/index.php" method="post">
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
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/project/snippets/footer.php'; ?>
    </footer>
</body>
</html>
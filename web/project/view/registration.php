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
                <label for="accountName"><span>Account Name (Email Address)</span><span class="field-tip">Required</span></label> 
                <input id="accountName" name="accountName" type="email" autocomplete="email" required>
            </div>
            <div class="fields">
                <label for="password1"><span>Password</span><span class="field-tip">Required</span></label>
                <input id="password1" name="password1" type="password" autocomplete="new-password" required>
            </div>
            <div class="fields">
                <label for="password"><span>Verify Password</span><span class="field-tip">Required</span></label>
                <input id="password2" name="password2" type="password" autocomplete="new-password" required>
            </div>
            <div class="fields">
                <label for="fname"><span>First Name</span><span class="field-tip">Required</span></label> 
                <input id="fname" name="fname" type="text" autocomplete="given-name" required>
            </div>
            <div class="fields">
                <label for="lname"><span>Last Name</span><span class="field-tip">Required</span></label>
                <input id="lname" name="lname" type="text" autocomplete="family-name" required>
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
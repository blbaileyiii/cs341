<!DOCTYPE html>
<html lang="en-us">

<head>
    <?php $page = "LOGIN" ?>
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/common/head.php'; ?>
</head>

<body>
    <aside>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/common/alert.php'; ?>
    </aside>
    <header>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/common/nav.php'; ?>
    </header>    
    <main>
        <section>
            <h1><?php echo ucwords($page); ?></h1>
            <?php
                if (isset($_SESSION['message'])) { 
                        echo $_SESSION['message']; 
                        unset($_SESSION['message']);
                }
            ?>
            <form class="row gap" action="/account/" method="post">
                <div class="fields">
                    <label for="account"><span>Account Name (Email Address)</span><span class="field-tip">Required</span></label>
                    <input id="account" name="account" type="text" autocomplete="username" required>
                </div>
                <div class="fields">
                    <label for="password"><span>Password</span><span class="field-tip">Required</span></label>
                    <input id="password" name="password" type="password" autocomplete="current-password" required>                    
                </div>
                <div class="non-fields">
                    <button id="action" name="action" value="Login" type="submit">Login</button>
                </div>
                <div class="non-fields">
                    <div class="button">
                        <a href="?action=createAccount" title="HHSCamps - Create Account">Create Account</a>
                    </div>                    
                </div>
            </form>
        </section>
    </main>
    <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/common/footer.php'; ?>
    </footer>
</body>
</html>
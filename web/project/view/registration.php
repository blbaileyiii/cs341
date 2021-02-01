<!DOCTYPE html>
<html lang="en-us">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Echoes of Whimsy - Registration</title>
    <meta name="Echoes of Whimsy"
        content="Echoes of Whimsy - Registration">
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
        <h1>Registration</h1>
        <form action="/project/accounts/index.php" method="post">
            <div>
                <label for="fName"><span>First Name</span><span>Required</span></label> 
                <input id="fName" name="fName" type="text" autocomplete="given-name" required>
            </div>
            <div>
                <label for="lName"><span>Last Name</span><span>Required</span></label>
                <input id="lName" name="lName" type="text" autocomplete="family-name" required>
            </div>
            <div>
                <label for="email"><span>Email Address</span><span>Required</span></label>
                <input id="email" name="email" type="email" autocomplete="email" required>
            </div>
            <div>
                <label for="password"><span>Password</span><span>Required</span></label>
                <input id="password" name="password" type="password" autocomplete="new-password" required>
            </div>
            <div>
                <button type="submit">Register</button>
            </div>            
        </form>
    </main>
    <footer>
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/project/snippets/footer.php'; ?>
    </footer>
</body>
</html>
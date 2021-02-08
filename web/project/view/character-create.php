<!DOCTYPE html>
<html lang="en-us">

<head>
    <?php $page = "Character Creation" ?>
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/project/snippets/head.php'; ?>
</head>

<body>
    <header>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/project/snippets/header.php'; ?>
    </header>
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/project/snippets/nav.php'; ?>   
    <main>    
        <h1><?php echo $page ?></h1>
        <form>
            <div class="fields">
                <label for=''><span></span><span class="field-tip">Required</span></label>
                <input id='' name='' type="text" required>
            </div>
            <div class="fields">
                <label for=''><span></span><span class="field-tip">Required</span></label>
                <select value="" required>
                    <option selected disabled>Choose a Race</option>
                    <?php echo $playableOptions ?>
                </select>
            </div>
            <div class="fields">
                <label for=''><span></span><span class="field-tip">Required</span></label>
                <input id='' name='' type="text" required>
            </div>
            <div class="fields">
                <label for=''><span></span><span class="field-tip">Required</span></label>
                <input id='' name='' type="text" required>
            </div>
            <div class="fields">
                <label for=''><span></span><span class="field-tip">Required</span></label>
                <input id='' name='' type="text" required>
            </div>
            <div class="fields">
                <label for=''><span></span><span class="field-tip">Required</span></label>
                <input id='' name='' type="text" required>
            </div>
        </form>
    </main>
    <footer>
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/project/snippets/footer.php'; ?>
    <?php //var_dump($playableRaces) ?>
    </footer>
</body>
</html>
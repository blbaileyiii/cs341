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
        <form class="form" action="/project/character/index.php" method="post">
            <div class="fields">
                <label for='charname'><span>Name</span><span class="field-tip">Required</span></label>
                <input id='charname' name='charname' type="text" required>
            </div>
            <div class="fields">
                <label for='txgenusid'><span>Race</span><span class="field-tip">Required</span></label>
                <select id='txgenusid' name='txgenusid' value="" required>
                    <option selected disabled>Choose a Race</option>
                    <?php echo $playableOptions ?>
                </select>
            </div>
            <div class="fields">
                <label for='STR'><span>Strength</span><span class="field-tip">Required</span></label>
                <input id='STR' name='STR' type="number" step="1" min="1" placeholder="1" required>
            </div>
            <div class="fields">
                <label for='DEX'><span>Dexterity</span><span class="field-tip">Required</span></label>
                <input id='DEX' name='DEX' type="number" step="1" min="1" placeholder="1" required>
            </div>
            <div class="fields">
                <label for='AGL'><span>Agility</span><span class="field-tip">Required</span></label>
                <input id='AGL' name='AGL' type="number" step="1" min="1" placeholder="1" required>
            </div>
            <div class="fields">
                <label for='END'><span>Endurance</span><span class="field-tip">Required</span></label>
                <input id='END' name='END' type="number" step="1" min="1" placeholder="1" required>
            </div>
            <div class="fields">
                <label for='INT'><span>Intelligence</span><span class="field-tip">Required</span></label>
                <input id='INT' name='INT' type="number" step="1" min="1" placeholder="1" required>
            </div>
            <div class="fields">
                <label for='ATH'><span>Authority</span><span class="field-tip">Required</span></label>
                <input id='ATH' name='ATH' type="number" step="1" min="1" placeholder="1" required>
            </div>
            <div class="fields">
                <label for='PER'><span>Perception</span><span class="field-tip">Required</span></label>
                <input id='PER' name='PER' type="number" step="1" min="1" placeholder="1" required>
            </div>
            <div class="fields">
                <label for='LCK'><span>Luck</span><span class="field-tip">Required</span></label>
                <input id='LCK' name='LCK' type="number" step="1" min="1" placeholder="1" required>
            </div>
            <div class="fields">
                <label for='CHA'><span>Charisma</span><span class="field-tip">Required</span></label>
                <input id='CHA' name='CHA' type="number" step="1" min="1" placeholder="1" required>
            </div>
            <div class="non-fields">
                <button id="action" name="action" value="save-new" type="submit">Save Character</button>
            </div>  
        </form>
    </main>
    <footer>
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/project/snippets/footer.php'; ?>
    <?php //var_dump($playableRaces) ?>
    </footer>
</body>
</html>
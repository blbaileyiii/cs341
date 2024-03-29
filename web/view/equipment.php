<!DOCTYPE html>
<html lang="en-us">

<head>
    <?php $page = "Template" ?>
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
        <div class="equipment">
            <section>
                <div class="section-center">
                    <img class="responsive" src="/images/equipment-w1280x400.webp" alt="camping gear">
                    <h1>Equipment List</h1>
                    <p>(Please label all of your belongings with your name and ward name)</p>
                    <div id="equipment-lists"><h2>LOADING EQUIPMENT LIST...</h2></div>
                    <div>
                        <h2>Hydration Requirements</h2>
                        <p>We all should constantly manage our hydration level during all camp activities. Daytime temperatures, dry climate, and elevation, coupled with strenuous outdoor activities can increase how quickly we may become dehydrated. Although water is available during mealtimes, as well as before and after activity times, each participant MUST carry water for all activities conducted away from camp (e.g. hikes, waterfront, climbing, etc.)</p>
                        <p>The American College of Sports Medicine recommends drinking 1 liter of water per hour for moderate activity in moderate conditions. This is equivalent to two 16.9 oz/500ml bottles of water per hour. Everyone should come to camp with an appropriate hydration system. Examples of hydration systems include: hydration packs, canteens, reusable water bottles, and flasks. The required size of the system is dependent on camp level and activity.</p>
                    </div>
                </div>
            </section>
        </div>
    </main>
    <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/common/footer.php'; ?>
    </footer>
    <script type="module" src="/js/equipment-main.js"></script>
</body>
</html>
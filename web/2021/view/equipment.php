<!DOCTYPE html>
<html lang="en-us">

<head>
    <?php $page = "Template" ?>
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/2021/common/head.php'; ?>
</head>

<body>
    <aside>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/2021/common/alert.php'; ?>
    </aside>
    <header>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/2021/common/nav.php'; ?>
    </header>    
    <main>
        <div class="equipment">
            <section>
                <div class="section-center">
                    <img class="responsive" src="/2021/images/equipment-w1280x400.webp" alt="camping gear">
                    <h1>Equipment List</h1>
                    <p>Duffle bags or small suitcases are preferred for packing.</p>
                    <p>(Please label all of your belongings with your name and ward name)</p>
                    <div id="equipment-lists"><h2>LOADING EQUIPMENT LIST...</h2></div>
                    <div>
                        <h3>Hydration Requirements</h3>
                        <p>We all should constantly manage our hydration level during all camp activities. Daytime temperatures, dry climate, and elevation, coupled with strenuous outdoor activities can increase how quickly we may become dehydrated. Although water is available at the lodge during mealtimes, as well as before and after activity times, each participant MUST carry water for all activities conducted away from the lodge (e.g. hikes, waterfront, climbing, etc.)</p>
                        <p>The American College of Sports Medicine recommends drinking 1 liter of water per hour for moderate activity in moderate conditions. This is equivalent to two 16.9 oz/500ml bottles of water per hour. Everyone should come to camp with an appropriate hydration system. Examples of hydration systems include: hydration packs, canteens, reusable water bottles, and flasks. The required size of the system is dependent on camp level and activity.</p>
                    </div>
                </div>
            </section>
        </div>
    </main>
    <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/2021/common/footer.php'; ?>
    </footer>
    <script type="module" src="/2021/js/equipment-main.js"></script>
</body>
</html>
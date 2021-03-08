<!DOCTYPE html>
<html lang="en-us">

<head>
    <?php $page = "YM Camp 2021" ?>
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/2021/common/head.php'; ?>
</head>

<body>
    <header>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/2021/common/header-nav.php'; ?>
    </header>
    <main>    
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/2021/common/countdown.php'; ?>
        <div class="schedule">
            <h2>Schedule</h2>
            <ul>
                <li><span>07:00 AM</span><span>Wake-up</span></li>
                <li><span>07:30 AM</span><span>Flag Ceremony</span></li>
                <li><span>07:45 AM</span><span>Devotional; Scripture Study</span></li>
                <li><span>08:00 AM</span><span>Breakfast</span></li>
                <li><span>08:45 AM</span><span>Cleanup/Announcements</span></li>
                <li><span>09:00 AM</span><span>Morning Activities</span></li>
                <li><span>12:30 PM</span><span>Lunch</span></li>
                <li><span>01:15 PM</span><span>Cleanup/Announcements</span></li>
                <li><span>01:30 PM</span><span>Afternoon Activities</span></li>
                <li><span>05:00 PM</span><span>Retire Flag</span></li>
                <li><span>05:15 PM</span><span>Dinner</span></li>
                <li><span>06:00 PM</span><span>Cleanup/Announcements</span></li>
                <li><span>06:15 PM</span><span>Evening Activities</span></li>
                <li><span>09:00 PM</span><span>Cleanup</span></li>
                <li><span>10:00 PM</span><span>Lights-out</span></li>
            </ul>
        </div>
        <div class="pillars"></div>
        <div class="gallery"></div>
        <div class="FAQ"></div>
        <div class="contact"></div>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/2021/common/scripture.php'; ?>
    </main>
    <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/2021/common/footer.php'; ?>
    </footer>
    <script src="js/countdown.js"></script>
</body>
</html>
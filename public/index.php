<?php

require_once __DIR__ . '/../weatherAPI/curlRequest.php';
$api = new Requester();
$result = $api->APICall();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SUc/Weatherapp</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Poppins:wght@500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <script async defer src="js/script.js"></script>
</head>

<body>
    <!-- APP -->
    <section class="appLayout container">
        <!-- button for change C° to F° -->
        <button class="switchDegree" onclick="">C°/F°</button>
        <!-- SEARCH AREA FOR USER INPUT -->
        <h2 class="textSearch">Right now in, <input type="text" name="location" id="location" oninput="this.size = this.value.length + 1" placeholder="Paris, France"> it's <span class="weather"></span>.</h2>
        <!-- THIS DAY -->
        <div class="currentDay container">
            <div class="currentDay-icon">A</div>
            <div class="currentDay-Temp">B</div>
            <div class="currentDay-Infos">
                <div class="wind">a</div>
                <div class="rain">b</div>
                <div class="humidity">c</div>
            </div>
        </div>
        <!-- OTHER DAYS -->
        <div class="nextDays container">
            <!-- TOMORROW -->
            <div class="daysAfter"></div>
            <div class="daysAfter"></div>
            <div class="daysAfter"></div>
        </div>
    </section>

</body>

</html>
<!DOCTYPE html>
<?php

require_once __DIR__ . '/../weatherAPI/curlRequest.php';
$api = new Requester();
if (isset($_GET['location'])) {
    $location = $_GET['location'] ?? "Paris, France";
    $result = $api->getData();
    $iconURL = "http://openweathermap.org/img/wn/" . $result['currentDay']['iconWeather'] . "@2x.png";
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SUc/Weatherapp</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mouse+Memoirs&family=Inter:wght@300;400;500;600&family=Poppins:wght@500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <script async defer src="js/script.js"></script>
</head>

<body>
    <!-- APP -->
    <section class="appLayout container">
        <!-- button for change C° to F° -->
        <!-- <button class="switchDegree" onclick="">C°/F°</button> -->
        <!-- SEARCH AREA FOR USER INPUT -->
        <form action="">
            <h2 class="textSearch">Right now in,
                <input type="text" name="location" id="location" size="10" oninput="this.size = this.value.length" placeholder="Paris, France" value="<?= $location ?>"> <br>
                it's <span class="weather"><?= $result['currentDay']['description']; ?></span>.
                <button formmethod="GET" type="submit">GO ➔ </button>
            </h2>
            <!-- THIS DAY -->
        </form>

        <section class="currentDay container">

            <img class="currentIcon" src="<?= $iconURL ?>">

            <div class="currentDay-Temp">
                <h4 class="currentHour">Right now</h4>
                <div class="temp actualTemp"><?= round($result['currentDay']['actualTemp'], 1) ?> C°</div>
                <span class="linebreak"> -------------- </span>
                <h4 class="currentHour"><?= Requester::timeHourMin($result['currentDay']['time12']) ?> H</h4>
                <div class="temp twelveHTemp"><?= round($result['currentDay']['twelveHTemp'], 1) ?> C°</div>
            </div>

            <div class="currentDay-Infos">
                <div class="wind">
                    <h4>Wind speed :</h4>
                    <p><?= $result['currentDay']['windSpeed'] . ' m/s' ?></p>
                </div>
                <div class="rain">
                    <h4>Precipitiation :</h4>
                    <p><?= $result['currentDay']['precipitation'] . ' %' ?></p>
                </div>
                <div class="humidity">
                    <h4>Humidity :</h4>
                    <p class="humResult"><?= $result['currentDay']['humidity'] . ' %' ?></p>
                </div>
            </div>
        </section>
        <!-- OTHER DAYS -->
        <section class="nextDays container">
            <!-- TOMORROW -->
            <div class="daysAfter day1">
                <h4 class="nameDay_next"><?= Requester::timeDayMonth($result['nextDay']['time']) ?></h4>

                <div class="afterday_icon">
                    <img src="<?= "http://openweathermap.org/img/wn/" . $result['nextDay']['iconWeather'] . "@2x.png" ?>" alt="">
                </div>

                <div class="tempOtherDay">
                    <h6 class="hourTemp"><?= Requester::timeHourMin($result['nextDay']['time']) ?> H</h6>
                    <div class="afterday_temp0"><?= round($result['nextDay']['actualTemp'], 1) ?> C°</div>
                    <span class="linebreak"> ------- </span>
                    <h6 class="hourTemp"><?= Requester::timeHourMin($result['nextDay']['timePlus12']) ?> H</h6>
                    <div class="afterday_temp12"><?= round($result['nextDay']['twelveHTemp'], 1) ?> C°</div>
                </div>
            </div>

            <div class="daysAfter day2">
                <h4 class="nameDay_next"><?= Requester::timeDayMonth($result['dayTwo']['time']) ?></h4>

                <div class="afterday_icon">
                    <img src="<?= "http://openweathermap.org/img/wn/" . $result['dayTwo']['iconWeather'] . "@2x.png" ?>" alt="">
                </div>

                <div class="tempOtherDay">
                    <h6 class="hourTemp"><?= Requester::timeHourMin($result['dayTwo']['time']) ?> H</h6>
                    <div class="afterday_temp0"><?= round($result['dayTwo']['actualTemp'], 1) ?> C°</div>
                    <span class="linebreak"> ------- </span>
                    <h6 class="hourTemp"><?= Requester::timeHourMin($result['dayTwo']['timePlus12']) ?> H</h6>
                    <div class="afterday_temp12"><?= round($result['dayTwo']['twelveHTemp'], 1) ?> C°</div>
                </div>

            </div>

            <div class="daysAfter day3">
                <h4 class="nameDay_next"><?= Requester::timeDayMonth($result['dayThree']['time']) ?></h4>

                <div class="afterday_icon">
                    <img src="<?= "http://openweathermap.org/img/wn/" . $result['dayThree']['iconWeather'] . "@2x.png" ?>" alt="">
                </div>
                <div class="tempOtherDay">
                    <h6 class="hourTemp"><?= Requester::timeHourMin($result['dayThree']['time']) ?> H</h6>
                    <div class="afterday_temp0"><?= round($result['dayThree']['actualTemp'], 1) ?> C°</div>
                    <span class="linebreak"> ------- </span>
                    <h6 class="hourTemp"><?= Requester::timeHourMin($result['dayThree']['timePlus12']) ?> H</h6>
                    <div class="afterday_temp12"><?= round($result['dayThree']['twelveHTemp'], 1) ?> C°</div>
                </div>
            </div>
        </section>
    </section>

</body>

</html>
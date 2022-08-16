<?php

class Requester
{
    public function getLatLong($city='Paris',$country='', $stateCode = '')
    {
        if($stateCode !== '')
        {
            if($country !== '')
            {
                $query = "$city,$stateCode,$country";

            }else $query = "$city,$stateCode";
            
        } elseif ($country !== ''){

            $query = "$city,$country";

        } else $query = $city;

        $url = "http://api.openweathermap.org/geo/1.0/direct?q=$query&limit=5&appid=f384d81b62089a0cb2f7bd55d0abab32";

        $req = curl_init($url);

        curl_setopt_array($req, [
            CURLOPT_RETURNTRANSFER => true, 
        ]);
        $data = curl_exec($req);
        
        if (!$data)
        {
            var_dump(curl_error($req));
        } else {
            $data = json_decode($data,true);
        }
        curl_close($req);
        // echo '<pre>';
        // var_dump($data);
        // echo '</pre>';
        // exit;
        // $jsonResponse = [
        //     $lat = $data['0]->lat
        // ];
        return $data;
    }

    public function weatherFromGeo($lat, $long)
    {
        $url = "https://api.openweathermap.org/data/2.5/forecast?lat=$lat&lon=$long&appid=f384d81b62089a0cb2f7bd55d0abab32&units=metric";

        $req = curl_init($url);

        curl_setopt_array($req, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false
        ]);
        $data = curl_exec($req);

        if (!$data) {
            var_dump(curl_error($req));
        } else {
            $data = json_decode($data, true);
        }
        curl_close($req);

        return $data;
    }

    public function getData()
    {
        $temp = $_GET['location'];

        // $tempArr = preg_split("/[\s,]+/", $temp);
        $tempArr = explode(',', $temp);
        $city = $tempArr[0] ?? '';
        $country = $tempArr[1] ?? '';
        $stateCode = $tempArr[2] ?? '';
        $data = $this->getLatLong($city,$country,$stateCode);
        $lat = $data['0']['lat'] ?? 48.8588897;
        $long = $data['0']['lon'] ?? 2.3200410217200766;
        
        $data = $this->weatherFromGeo($lat,$long);
        $precipitation = $data["list"][0]['pop'] * 100;
    
        $weatherData = [
            'currentDay' => [
                'main' => $data["list"][0]['weather'][0]['main'],
                'description' => $data["list"][0]['weather'][0]['description'],
                'iconWeather' => $data["list"][0]['weather'][0]['icon'],
                'actualTemp' => $data["list"][0]['main']['temp'],
                'twelveHTemp' => $data["list"][3]['main']['temp'],
                'windSpeed' => $data["list"][0]['wind']['speed'],
                'humidity' => $data["list"][0]['main']['humidity'],
                'precipitation' => $precipitation,
                'time' => $data['list'][0]['dt'],
                'time12' => $data['list'][3]['dt'],
            ],
            'nextDay' => [
                'iconWeather' => $data["list"][8]['weather'][0]['icon'],
                'actualTemp' => $data["list"][8]['main']['temp'],
                'twelveHTemp' => $data["list"][12]['main']['temp'],
                'time' => $data["list"][8]['dt'],
                'timePlus12' => $data["list"][12]['dt'],
            ],
            'dayTwo' => [
                'iconWeather' => $data["list"][16]['weather'][0]['icon'],
                'actualTemp' => $data["list"][16]['main']['temp'],
                'twelveHTemp' => $data["list"][20]['main']['temp'],
                'time' => $data["list"][16]['dt'],
                'timePlus12' => $data["list"][20]['dt'],
            ],
            'dayThree' => [
                'iconWeather' => $data["list"][24]['weather'][0]['icon'],
                'actualTemp' => $data["list"][24]['main']['temp'],
                'twelveHTemp' => $data["list"][28]['main']['temp'],
                'time' => $data["list"][24]['dt'],
                'timePlus12' => $data["list"][28]['dt'],
            ],
        ];
        // var_dump($this->convertToDate($data["list"][1]['dt']));
        return $weatherData;
    }

    public static function timeHourMin($timestamp)
    {
        $time = date('H:i',$timestamp);
        return $time;
    }

    public static function timeDayMonth($timestamp)
    {
        $time = date('d/m', $timestamp);
        return $time;
    }

}

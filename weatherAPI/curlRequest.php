<?php

class Requester
{
    public function APICall($city='Paris',$country='', $stateCode = '')
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
            $data = json_decode($data);
        }
        curl_close($req);
        // echo '<pre>';
        // var_dump($data);
        // echo '</pre>';
        // exit;
        return $data;
    }
}

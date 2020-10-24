<?php

namespace App\API;

use App\Contracts\WeatherInterface;

class Weather implements WeatherInterface
{
    /** OpenWeatherMapのAPIKEY */
    private $api_key;
    /** 都市名 */
    private $city_name;

    /**
     * APIを叩く際に必要なパラメータをセット
     * 
     * @param array $params
     */
    public function setParams($params)
    {
        $this->api_key = $params["api_key"];
        $this->city_name = $params["city_name"];
    }

    /**
     * OpenWeatherMapのAPIをたたく
     * 
     * @return array
     */
    public function weatherApi()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "api.openweathermap.org/data/2.5/weather?q=" . $this->city_name . "&appid=" . $this->api_key,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            return json_decode($response);
        }
    }
}
